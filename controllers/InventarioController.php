<?php

namespace app\controllers;

use Yii;
use app\models\Inventario;
use app\models\ItemInventario;
use app\models\InventarioSearch;
use app\models\TerminoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\assets\AppAccessRule;
use app\assets\AppDate;
use app\assets\AppHandlingErrors;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
            'access' => [
               'class' => AccessControl::className(),
               'ruleConfig' => [
                   'class' => AppAccessRule::className(),
               ],
               'only' => [ 'index','view','create','update','delete' ],
               'rules' => [
                    [
                       'actions' => [ 'index','view','create','update','delete' ],
                       'allow' => true,
                       'roles' => ["?"],
                    ],
                    [
                       'actions' => [ 'index','view' ],
                       'allow' => true,
                       'roles' => ["Gasto-view-*"],
                    ],
                    [
                       'actions' => [ 'create' ],
                       'allow' => true,
                       'roles' => ["Gasto-create-*"],
                    ],
                    [
                       'actions' => [ 'update' ],
                       'allow' => true,
                       'roles' => ["Gasto-update-*"],
                    ],
                    [
                       'actions' => [ 'delete' ],
                       'allow' => true,
                       'roles' => ["Gasto-delete-*"],
                    ],
               ],
            ],
        ];
    }

    /**
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = InventarioSearch::searchInventarioBorrador();
        $borrador = false;
        if ( $model != null ){
            $borrador = true;
        }
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'borrador' => $borrador,
        ]);
    }

    /**
     * Displays a single Inventario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->fecha = AppDate::stringToDate($model->fecha , Yii::$app->params['formatViewDate'] );
        $model->fecha_registro = AppDate::stringToDate($model->fecha_registro , Yii::$app->params['formatViewDate'] );
        return $this->render('view', [ 'model' => $model , 'items' => $model->getAllItemInventarios()]);
    }

    /**
     * Creates a new Inventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = InventarioSearch::searchInventarioBorrador();
        if ( $model != null ) {
            return $this->redirect(['update', 'id' => $model->codigo]);
        } else {
            
            $model = new Inventario();
            $model->fecha = AppDate::date();
            $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->origen = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->estado = TerminoSearch::estadoInventarioBorrador()->codigo;
            $model->usuario_registro = Yii::$app->user->identity->codigo;
            $model->fecha_registro = AppDate::date();
            $model->codigoBarras = "xxxxxxxxxxxxxx";

            if ( $model->save() ) {
                return $this->redirect(['update', 'id' => $model->codigo  ]);
            } else {
                AppHandlingErrors::setFlash( 'danger' , json_encode($model->getErrors()) );
                return $this->redirect(['index']);
            }

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
        $itemModel = new ItemInventario();
        $itemModel->inventario = $model->codigo;
        $model->fecha = AppDate::stringToDate($model->fecha , Yii::$app->params['formatViewDate'] );
        return $this->render('update', [ 'model' => $model , 'itemModel' => $itemModel , 'listInventory' => $model->itemInventarios ]);
    }

    public function actionSave($id)
    {   
        $model = $this->findModel($id);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ( count( $model->itemInventarios ) > 0 ) {
                $inventariosActivos = InventarioSearch::searchInventariosActivos();
                foreach ( $inventariosActivos as $inventario) {
                    if ( $inventario->codigo != $id) {
                        $inventario->estado = TerminoSearch::estadoInventarioNoActivo()->codigo;
                        $inventario->codigoBarras = 'xxxxxxxxxxxxxx';
                        if ( !$inventario->save() ) {
                            $transaction->rollBack();
                            AppHandlingErrors::setFlash( 'danger' , 'No se logro guardar el inventario ' );
                            $itemModel = new ItemInventario();
                            $model->fecha = AppDate::stringToDate($model->fecha , Yii::$app->params['formatViewDate'] );
                            return $this->render('update', [ 'model' => $model , 'itemModel' => $itemModel , 'listInventory' => $model->itemInventarios ]);
                        }
                    }
                }
                $model->estado = TerminoSearch::estadoInventarioActivo()->codigo;
                $model->codigoBarras = 'xxxxxxxxxxxxxx';
                if( $model->save() ){
                    $transaction->commit();
                    AppHandlingErrors::setFlash( 'success' , 'Inventario guardado correctamente.' );
                    return $this->redirect(['index']);
                } else {
                    $transaction->rollBack();
                    AppHandlingErrors::setFlash( 'danger' , 'No se logro guardar el inventario' );
                    $itemModel = new ItemInventario();
                    $model->fecha = AppDate::stringToDate($model->fecha , Yii::$app->params['formatViewDate'] );
                    return $this->render('update', [ 'model' => $model , 'itemModel' => $itemModel , 'listInventory' => $model->itemInventarios ]);
                }
            
            } else {
                $transaction->rollBack();
                AppHandlingErrors::setFlash( 'danger' , 'El inventario no tiene ningun producto en la lista' );
                $itemModel = new ItemInventario();
                $model->fecha = AppDate::stringToDate($model->fecha , Yii::$app->params['formatViewDate'] );
                return $this->render('update', [ 'model' => $model , 'itemModel' => $itemModel , 'listInventory' => $model->itemInventarios ]);
            }
        
        } catch (Exception $e) {
            $transaction->rollBack();
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
