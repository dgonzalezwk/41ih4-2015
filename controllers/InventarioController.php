<?php

namespace app\controllers;

use Yii;
use app\assets\AppAccessRule;
use app\assets\AppDate;
use app\assets\AppHandlingErrors;
use app\models\Inventario;
use app\models\InventarioSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * InventarioController implements the CRUD actions for Inventario model.
 */
class InventarioController extends Controller
{
    public $layout = 'administracion';
    public $modelModulo;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            #'access' => [
               #'class' => AccessControl::className(),
               #'ruleConfig' => [
                   #'class' => AppAccessRule::className(),
               #],
               #'only' => [ 'index','view','create','update','delete','login','logout' ],
               #'rules' => [
                   #[
                       #'actions' => [ 'login','logout' ],
                       #'allow' => true,
                       #'roles' => ['@'],
                   #],
                   #[
                       #'actions' => [ 'index','view' ],
                       #'allow' => true,
                       #'roles' => ["inventario-view-*"],
                   #],
                   #[
                       #'actions' => [ 'create' ],
                       #'allow' => true,
                       #'roles' => ["inventario-create-*"],
                   #],
                   #[
                       #'actions' => [ 'update' ],
                       #'allow' => true,
                       #'roles' => ["inventario-update-*"],
                   #],
                   #[
                       #'actions' => [ 'delete' ],
                       #'allow' => true,
                       #'roles' => ["inventario-delete-*"],
                   #],
               #],
            #],
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
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventario model.
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
     * Creates a new Inventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inventario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inventario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
