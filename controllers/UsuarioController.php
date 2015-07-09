<?php

namespace app\controllers;

use Yii;
use app\assets\AppDate;
use app\assets\AppAccessRule;
use app\assets\AppHandlingErrors;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\AccionUsuario;
use app\models\AccionUsuarioSearch;
use app\models\AccionSearch;
use app\models\PuntoVentaSearch;
use app\models\Modulo;
use app\models\LoginForm;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\UsuarioPuntoVenta;
use app\models\UsuarioPuntoVentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    public $layout = 'administracion';
    public $modelModulo;

    public function behaviors()
    {
        $this->modelModulo = new Modulo();
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
               'class' => AccessControl::className(),
               'ruleConfig' => [
                   'class' => AppAccessRule::className(),
               ],
               'only' => [ 'index','view','create','update','delete','login','logout' ],
               'rules' => [
                   [
                       'actions' => [ 'login','logout' ],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
                   [
                       'actions' => [ 'index','view' ],
                       'allow' => true,
                       'roles' => ["Usuario-view-*"],
                   ],
                   [
                       'actions' => [ 'create' ],
                       'allow' => true,
                       'roles' => ["Usuario-create-*"],
                   ],
                   [
                       'actions' => [ 'update' ],
                       'allow' => true,
                       'roles' => ["Usuario-update-*"],
                   ],
                   [
                       'actions' => [ 'delete' ],
                       'allow' => true,
                       'roles' => ["Usuario-delete-*"],
                   ],

               ],
            ],
        ];
    }

    public function beforeAction($action) 
    {
        $this->enableCsrfValidation = false;
        if (parent::beforeAction($action)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
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
        $model = new Usuario();
        $permisos = null;
        $puntosVentaSeleccionados = null;

        if ($model->load(Yii::$app->request->post())) {
            $stringDate = $model->fecha_nacimiento;
            $model->contrasena = base64_encode($model->contrasena);
            $model->fecha_nacimiento = AppDate::stringToDate($model->fecha_nacimiento , null );
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $permisos = Yii::$app->request->post( 'permisos' , null );
                $puntosVentaSeleccionados = Yii::$app->request->post("puntos_venta_asignados" , null );

                if ($model->save()){

                        if ( is_array( $permisos ) ) {
                            foreach ($permisos as $accion) {
                                $modelAccionUsuario = new AccionUsuario();
                                $modelAccionUsuario->load(  [ 'AccionUsuario' => [
                                        'accion' => $accion,
                                        'usuario' => $model->codigo,
                                        'estado' => 1,
                                    ],
                                ]);
                                if ( !$modelAccionUsuario->save() ) {
                                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $modelAccionUsuario->getErrors() ) );
                                    $model->fecha_nacimiento = $stringDate;
                                    $model->contrasena = base64_decode($model->contrasena);
                                    $arrayModulos = $this->arregloAccionesModulo( $permisos );
                                    return $this->render('create', [ 'model' => $model , 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
                                }
                            }
                        }
                        if ( is_array( $puntosVentaSeleccionados ) ) {
                            foreach ($puntosVentaSeleccionados as $idPuntoVenta) {
                                $usuarioPuntoVenta = new UsuarioPuntoVenta();
                                $usuarioPuntoVenta->load( [ 'UsuarioPuntoVenta' => [
                                        'usuario' => $model->codigo,
                                        'punto_venta' => $idPuntoVenta,
                                        'estado' => 1,
                                    ]
                                ] );
                                if ( !$usuarioPuntoVenta->save() ) {
                                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $usuarioPuntoVenta->getErrors() ) );
                                    $model->fecha_nacimiento = $stringDate;
                                    $model->contrasena = base64_decode($model->contrasena);
                                    $arrayModulos = $this->arregloAccionesModulo( $permisos );
                                    return $this->render('create', [ 'model' => $model , 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
                                }
                            }
                        }
                        
                        $transaction->commit();
                        AppHandlingErrors::setFlash( 'success' , 'Datos del Usuario guardados correctamente.' );                    
                        return $this->redirect(['view', 'id' => $model->codigo]);
                } else {

                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
                    $model->fecha_nacimiento = $stringDate;
                    $model->contrasena = base64_decode($model->contrasena);
                    $arrayModulos = $this->arregloAccionesModulo( $permisos );
                    return $this->render('create', [ 'model' => $model , 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
                }

            } catch (Exception $e) {

                $arrayModulos = $this->arregloAccionesModulo( $permisos );
                AppHandlingErrors::setFlash( 'danger' ,  $e->message );
                $transaction->rollBack();
                $model->fecha_nacimiento = $stringDate;
                $model->contrasena = base64_decode($model->contrasena);
                return $this->render('create', [ 'model' => $model , 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
            }
        } else {
            $arrayModulos = $this->arregloAccionesModulo( $permisos );
            return $this->render('create', [ 'model' => $model, 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
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
        $model = $this->findModel($id);
        $permisos = ArrayHelper::map( $model->accionUsuarios , 'codigo' , 'accion' );
        $puntosVentaSeleccionados = ArrayHelper::map( $model->usuarioPuntoVentas , 'codigo' , 'punto_venta' );;

        if ($model->load(Yii::$app->request->post())) {

            $stringDate = $model->fecha_nacimiento;
            $model->contrasena = base64_encode($model->contrasena);
            $model->fecha_nacimiento = AppDate::stringToDate($model->fecha_nacimiento , null );
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $permisos = Yii::$app->request->post( 'permisos' , null );
                $puntosVentaSeleccionados = Yii::$app->request->post("puntos_venta_asignados" , null );
                if ($model->save()){

                    $permisos = Yii::$app->request->post('permisos');
                    $acciones = AccionSearch::all();
                    foreach ( $acciones as $accion ) {
                        if ( is_array( $permisos ) && in_array( $accion->codigo , $permisos ) ) {
                            if ( AccionUsuarioSearch::isValido( $accion , $model ) ) {
                                $modelAccionUsuario = AccionUsuarioSearch::accionPorUsuario( $accion , $model );
                                if (  !$modelAccionUsuario->estado ) {
                                    $modelAccionUsuario->load([ 'AccionUsuario' => [
                                            'estado' => 1,
                                        ],
                                    ]);
                                    $modelAccionUsuario->save();
                                }
                            } else {
                                $modelAccionUsuario = new AccionUsuario();
                                $modelAccionUsuario->load([ 'AccionUsuario' => [
                                        'accion' => $accion->codigo,
                                        'usuario' => $model->codigo,
                                        'estado' => 1,
                                    ],
                                ]);
                                $modelAccionUsuario->save();
                            }
                        } else if ( AccionUsuarioSearch::isValido( $accion , $model ) ) {
                            $modelAccionUsuario = AccionUsuarioSearch::accionPorUsuario( $accion , $model );
                            if (  $modelAccionUsuario->estado ) {
                                $modelAccionUsuario->load([ 'AccionUsuario' => [
                                        'estado' => 0,
                                    ],
                                ]);
                                $modelAccionUsuario->save();
                            }
                        }
                    }
                    $puntosVenta = PuntoVentaSearch::all();
                    foreach ( $puntosVenta as $puntoVenta ) {
                        if ( is_array( $puntosVentaSeleccionados ) && in_array( $puntoVenta->codigo , $puntosVentaSeleccionados ) ) {
                            if ( UsuarioPuntoVentaSearch::isValido( $puntoVenta , $model ) ) {
                                $modelUsuarioPuntoVenta = UsuarioPuntoVentaSearch::puntoVentaPorUsuario( $puntoVenta , $model );
                                if (  !$modelUsuarioPuntoVenta->estado ) {
                                    $modelUsuarioPuntoVenta->load([ 'UsuarioPuntoVenta' => [
                                            'estado' => 1,
                                        ],
                                    ]);
                                    $modelUsuarioPuntoVenta->save();
                                }
                            } else {
                                $modelUsuarioPuntoVenta = new UsuarioPuntoVenta();
                                $modelUsuarioPuntoVenta->load([ 'UsuarioPuntoVenta' => [
                                        'punto_venta' => $puntoVenta->codigo,
                                        'usuario' => $model->codigo,
                                        'estado' => 1,
                                    ],
                                ]);
                                $modelUsuarioPuntoVenta->save();
                            }
                        } else if ( UsuarioPuntoVentaSearch::isValido( $accion , $model ) ) {
                            $modelUsuarioPuntoVenta = UsuarioPuntoVentaSearch::puntoVentaPorUsuario( $accion , $model );
                            if (  $modelUsuarioPuntoVenta->estado ) {
                                $modelUsuarioPuntoVenta->load([ 'UsuarioPuntoVenta' => [
                                        'estado' => 0,
                                    ],
                                ]);
                                $modelUsuarioPuntoVenta->save();
                            }
                        }
                    }

                    $transaction->commit();
                    AppHandlingErrors::setFlash( 'success' , 'Datos del Usuario guardados correctamente.' );
                    return $this->redirect(['view', 'id' => $model->codigo]);
                } else {

                    $arrayModulos = $this->arregloAccionesModulo( $permisos );
                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
                    $model->fecha_nacimiento = $stringDate;
                    $model->contrasena = base64_decode( $model->contrasena );
                    return $this->render('update', ['model' => $model, 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
                }
            } catch (Exception $e) {

                $arrayModulos = $this->arregloAccionesModulo( $permisos );

                AppHandlingErrors::setFlash( 'danger' ,  $e->message );
                $transaction->rollBack();
                $model->fecha_nacimiento = $stringDate;
                $model->contrasena = base64_decode($model->contrasena);
                return $this->render('update', ['model' => $model, 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
            }
        } else {
            
            $model->fecha_nacimiento = AppDate::stringToDate( $model->fecha_nacimiento , Yii::$app->params['formatViewDate'] );
            $model->contrasena = base64_decode( $model->contrasena );
            $arrayModulos = $this->arregloAccionesModulo( $permisos );
            return $this->render('update', ['model' => $model, 'modulos' => $arrayModulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] );
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
            $cookies = Yii::$app->response->cookies;
            $cookie = new \yii\web\Cookie([
                'name' => 'puntoVentaSelected',
                'value' => 0,
                'expire' => time() + 86400 * 365,
            ]);
            $cookies->add($cookie);
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

    public function actionCambiarPuntoVenta( $index )
    {

        $cookies = Yii::$app->response->cookies;
        $cookie = new \yii\web\Cookie([
            'name' => 'puntoVentaSelected',
            'value' => $index,
            'expire' => time() + 86400 * 365,
        ]);
        $cookies->add($cookie);
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

    protected function arregloAccionesModulo( $seleccionados ){

        $arrayModulos = [];
        $modulos = $this->modelModulo->find()->all();
        foreach ($modulos as $modulo) {
            $acciones = AccionSearch::accionesPorModulo($modulo);
            $arrayPermisos = [];
            $selected = [];
            foreach ( $acciones as $accion ) {
                if ( is_array( $seleccionados ) && in_array ( $accion->codigo , $seleccionados , true ) ) {
                    array_push( $selected , $accion->codigo );
                }
                array_push( $arrayPermisos , $accion );
            }
            $arrayModulos[$modulo->modulo] = [ 'seleccionados' => $seleccionados , 'permisos' => $arrayPermisos];
        }
        return $arrayModulos;

    }

}
