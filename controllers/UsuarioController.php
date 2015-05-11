<?php

namespace app\controllers;

use Yii;
use app\assets\AppDate;
use yii\filters\VerbFilter;
use app\models\AccionUsuario;
use app\models\AccionUsuarioSearch;
use app\models\AccionSearch;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\Modulo;
use app\models\LoginForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    public $layout = 'administracion';
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) 
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Usuario-view-*";

        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Usuario();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Usuario-view-*";

        $model = $this->findModel($id);
        $model->fecha_nacimiento = AppDate::stringToDate($model->fecha_nacimiento , Yii::$app->params['formatViewDate'] );
        return $this->render('view', [
            'model' => $model ,
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Usuario-create-*";

        $model = new Usuario();
        if ($model->load(Yii::$app->request->post())) {
            $stringDate = $model->fecha_nacimiento;
            $model->contrasena = base64_encode($model->contrasena);
            $model->fecha_nacimiento = AppDate::stringToDate($model->fecha_nacimiento , null );
            if ($model->save()){
                $permisos = Yii::$app->request->post('permisos');
                if ( is_array( $permisos ) ) {
                    foreach ($permisos as $accion) {
                        $modelAccionUsuario = new AccionUsuario();
                        $modelAccionUsuario->load(  [ 'AccionUsuario' => [
                                'accion' => $accion,
                                'usuario' => $model->codigo,
                                'estado' => true,
                            ],
                        ]);
                        $modelAccionUsuario->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->codigo]);
            } else {
                $model->fecha_nacimiento = $stringDate;
                $model->contrasena = base64_decode($model->contrasena);
                return $this->render('create', ['model' => $model,'modulos' => []] );
            }
        } else {
            $arrayModulos = [];
            $modulos = $modelModulo->find()->all();
            foreach ($modulos as $modulo) {
                $arrayPermisos = [];
                $acciones = AccionSearch::accionesPorModulo($modulo);
                foreach ( $acciones as $accion ) {
                    array_push( $arrayPermisos , $accion );
                }
                $arrayModulos[$modulo->modulo] = [ 'seleccionados' => null , 'permisos' => $arrayPermisos];
            }
            return $this->render('create', ['model' => $model, 'modulos' => $arrayModulos] );
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Usuario-update-*";

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $stringDate = $model->fecha_nacimiento;
            $model->contrasena = base64_encode($model->contrasena);
            $model->fecha_nacimiento = AppDate::stringToDate($model->fecha_nacimiento , null );
            if ($model->save())
            {
                $permisos = Yii::$app->request->post('permisos');
                $acciones = AccionSearch::all();
                foreach ( $acciones as $accion ) {
                    if ( is_array( $permisos ) && in_array( $accion->codigo , $permisos ) ) {
                        if ( AccionUsuarioSearch::isValido( $accion , $model ) ) {
                            $modelAccionUsuario = AccionUsuarioSearch::accionPorUsuario( $accion , $model );
                            if (  !$modelAccionUsuario->estado ) {
                                $modelAccionUsuario->load([ 'AccionUsuario' => [
                                        'estado' => true,
                                    ],
                                ]);
                                $modelAccionUsuario->save();
                            }
                        } else {
                            $modelAccionUsuario = new AccionUsuario();
                            $modelAccionUsuario->load([ 'AccionUsuario' => [
                                    'accion' => $accion->codigo,
                                    'usuario' => $model->codigo,
                                    'estado' => true,
                                ],
                            ]);
                            $modelAccionUsuario->save();
                        }
                    } else if ( AccionUsuarioSearch::isValido( $accion , $model ) ) {
                        $modelAccionUsuario = AccionUsuarioSearch::accionPorUsuario( $accion , $model );
                        if (  $modelAccionUsuario->estado ) {
                            $modelAccionUsuario->load([ 'AccionUsuario' => [
                                    'estado' => false,
                                ],
                            ]);
                            $modelAccionUsuario->save();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->codigo]);
            } else {
                $model->fecha_nacimiento = $stringDate;
                $model->contrasena = base64_decode($model->contrasena);
                return $this->render('update', ['model' => $model, 'modulos' => [] ] );
            }
        } else {
            
            $model->fecha_nacimiento = AppDate::stringToDate($model->fecha_nacimiento , Yii::$app->params['formatViewDate'] );
            $model->contrasena = base64_decode($model->contrasena);
            $arrayModulos = [];
            $modulos = $modelModulo->find()->all();
            foreach ($modulos as $modulo) {
                $acciones = AccionSearch::accionesPorModulo($modulo);
                $arrayPermisos = [];
                $selected = [];
                foreach ( $acciones as $accion ) {
                    if ( AccionUsuarioSearch::isValido( $accion , $model ) ) {
                        $modelAccionUsuario = AccionUsuarioSearch::accionPorUsuario( $accion , $model );
                        if (  $modelAccionUsuario->estado == true ) {
                            echo "accion:".$modelAccionUsuario->accion." usuario:".$modelAccionUsuario->usuario." estado:".$modelAccionUsuario->estado." \n";
                            array_push( $selected , $accion->codigo );
                        }
                    }
                    array_push( $arrayPermisos , $accion );
                }
                $arrayModulos[$modulo->modulo] = [ 'seleccionados' => $selected , 'permisos' => $arrayPermisos];
            }
            return $this->render('update', ['model' => $model, 'modulos' => $arrayModulos] );
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Usuario-delete-*";

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
