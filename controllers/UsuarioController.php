<?php

namespace app\controllers;

use Yii;
use app\assets\AppDate;
use yii\filters\VerbFilter;
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if ($model->load(Yii::$app->request->post())) {

            $stringDate = $model->fecha_nacimiento;
            $model->contrasena = base64_encode($model->contrasena);
            $model->fecha_nacimiento = AppDate::stringToDate($model->fecha_nacimiento);
            print_r($model->fecha_nacimiento);
            // if ($model->save())
            // {
            //     return $this->redirect(['view', 'id' => $model->codigo]);
            // }
            // else
            // {
            //     $model->fecha_nacimiento = $stringDate;
            //     $model->contrasena = base64_decode($model->contrasena);
                return $this->render('create', [
                    'model' => $model,
                ]);
            // }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
        if ($model->load(Yii::$app->request->post())) {
            $model->contrasena = base64_encode($model->contrasena);
            if ($model->save())
            {
                return $this->redirect(['view', 'id' => $model->codigo]);
            }
            else{
                $model->contrasena = base64_decode($model->contrasena);
                return $this->render('create', ['model' => $model,]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
