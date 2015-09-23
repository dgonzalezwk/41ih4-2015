<?php

namespace app\controllers;

use Yii;
use app\models\ItemInventario;
use app\models\ItemInventarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemInventarioController implements the CRUD actions for ItemInventario model.
 */
class ItemInventarioController extends Controller
{
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

    /**
     * Lists all ItemInventario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemInventarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemInventario model.
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
     * Creates a new ItemInventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new ItemInventario();

        if($itemDeLista->precio_unidad != $item->precio_unidad || $itemDeLista->precio_mayor != $item->precio_mayor){
            if ( !array_key_exists ( $key+"_old" , $listItems ) ) {
                $itemDeLista->estado = TerminoSearch::estadoItemInventarioRemplazado()->codigo;
                $itemDeLista->cantidad_actual = 0;
                $listItems[ $key+"_old" ] = $itemDeLista ;
                $newItem = new ItemInventario() ;
                $newItem->load( [ "ItemInventario" => [
                    "inventario" => $item->inventario,
                    "producto" => $item->producto,
                    "color" => $item->color,
                    "talla" => $item->talla,
                    "tipo" => $item->tipo,
                    "detalle" => $item->detalle,
                    "cantidad_esperada" => $item->cantidad_esperada,
                    "cantidad_defectuasa" => $item->cantidad_defectuasa,
                    "cantidad_entregada" => $item->cantidad_entregada,
                    "cantidad_actual" => $item->cantidad_actual,
                    "precio_unidad" => $item->precio_unidad,
                    "precio_mayor" => $item->precio_mayor,
                    "estado" => $item->estado,
                    "codigo_barras" => $item->codigo_barras,
                ] ] );
                $listItems[ $key ] = $newItem ;
            } else {
                $listItems[$key] = $item ;
            }
        } else {
            $itemDeLista->cantidad_esperada = $item->cantidad_esperada; 
            $itemDeLista->cantidad_defectuasa = $item->cantidad_defectuasa; 
            $itemDeLista->cantidad_entregada = $item->cantidad_entregada; 
            $itemDeLista->cantidad_actual = $item->cantidad_actual; 
            $listItems[$key] = $itemDeLista ;
        }

        if ( $model->load( Yii::$app->request->post() ) ) {
            
            if ( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa == 0 ){
                $model->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
            } else if( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa > 0 ) {
                $model->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
            } else if( $model->cantidad_esperada != $model->cantidad_entregada ) {
                $model->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
            }
            
            if ( $model->save() ) {
                return [ 'success' => true , 'datos' => [ 'codeBar' => $model->codigo_barras , 'cantidad_esperada' => $model->cantidad_esperada , 'cantidad_defectuasa' => $model->cantidad_defectuasa , 'cantidad_entregada' => $model->cantidad_entregada , 'precio_unidad' => $model->precio_unidad , 'precio_mayor' => $model->precio_mayor ] ];
            } else {
                return [ 'success' => false ];
            }
        } else {
            return [ 'success' => false ];
        }
    }

    /**
     * Updates an existing ItemInventario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel( $id );
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [ 'success' => true , 'datos' => [ 'codigo' => $model->codigo , 'codeBar' => $model->codigo_barras , 'cantidad_esperada' => $model->cantidad_esperada , 'cantidad_defectuasa' => $model->cantidad_defectuasa , 'cantidad_entregada' => $model->cantidad_entregada , 'precio_unidad' => $model->precio_unidad , 'precio_mayor' => $model->precio_mayor ] ];
        } else {
            return [ 'success' => false ];
        }
    }

    /**
     * Deletes an existing ItemInventario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemInventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemInventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemInventario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
