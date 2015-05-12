<?php

namespace app\controllers;

use Yii;
use app\models\PuntoVenta;
use app\models\PuntoVentaSearch;
use app\models\Accion;
use app\models\Modulo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PuntoVentaController implements the CRUD actions for PuntoVenta model.
 */
class PuntoVentaController extends Controller
{
    #se define el layout de administracion para mostrar las vistas 
    public $layout = "administracion" ;
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
                       'actions' => [ 'index','view' ],
                       'allow' => true,
                       'roles' => [$this->modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one()->codigo."-PuntoVenta-view-*"],
                   ],
                   [
                       'actions' => [ 'create' ],
                       'allow' => true,
                       'roles' => [$this->modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one()->codigo."-PuntoVenta-create-*"],
                   ],
                   [
                       'actions' => [ 'update' ],
                       'allow' => true,
                       'roles' => [$this->modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one()->codigo."-PuntoVenta-update-*"],
                   ],
                   [
                       'actions' => [ 'delete' ],
                       'allow' => true,
                       'roles' => [$this->modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one()->codigo."-PuntoVenta-delete-*"],
                   ],

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
     * Lists all PuntoVenta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PuntoVentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * muestra los datos de el punto de venta especificado.
     * @param integer $id
     * @return $this->render("view")
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * permite la creacion de un punto de venta
     * se al creacion es completada, se redireccionara a la accion view.
     * @return mixed
     */
    public function actionCreate()
    {
        #Accion de creaar punto de venta.
        $model = new PuntoVenta();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modulo = $modelModulo->find()->where(['modulo'=>'Ventas'])->one();
            
            $modelAction = new Accion;
            $modelAction->accion = 'Autorizacion de venta en '.$model->barrio." ".$model->direccion;
            $modelAction->descripcion = 'Esta accion corresponde a la autorizacion de venta en '.$model->barrio." ".$model->direccion;
            $modelAction->modulo = $modulo['codigo'];
            $modelAction->key = $modulo['codigo']."-PuntoVenta-sale-".$model->codigo;
            
            return $this->redirect(['view', 'id' => $model->codigo]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing PuntoVenta model.
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
     * Deletes an existing PuntoVenta model.
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
     * Finds the PuntoVenta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PuntoVenta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PuntoVenta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
