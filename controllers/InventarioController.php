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
        $model = InventarioSearch::searchInventarioBorrador();
        if ( $model != null ) {
            return $this->redirect(['update', 'id' => $model->codigo]);
        } else {
            
            $model = new Inventario();
            $model->fecha = AppDate::stringToDate($model->fecha , null );
            $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->origen = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->estado = TerminoSearch::estadoInventarioBorrador()->codigo;
            $model->usuario_registro = Yii::$app->user->identity->codigo;
            $model->fecha_registro = AppDate::stringToDate($model->fecha , null );

            if ( $model->save() ) {
                return $this->redirect(['update', 'id' => $model->codigo  ]);
            } else {
                AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $item->getErrors() ) );
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
        return $this->render('update', [ 'model' => $model , 'itemModel' => $itemModel , 'itemInventarios' => $model->itemInventarios ]);
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

    public function actionAddItem()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Inventario();
        $item = new ItemInventario();
        if ( $model->load( Yii::$app->request->post() ) && $item->load( Yii::$app->request->post() ) ){
            
            $model->usuario_registro = Yii::$app->user->identity->codigo ;
            $model->fecha_registro = AppDate::stringToDate( AppDate::date() , Yii::$app->params['formatViewDate'] ) ;
            $model->estado = TerminoSearch::estadoInventarioActivo()->codigo;
            
            if ( $item->cantidad_esperada == $item->cantidad_entregada && $item->cantidad_defectuasa == 0 ){
                $item->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
            } else if( $item->cantidad_esperada == $item->cantidad_entregada && $item->cantidad_defectuasa > 0 ) {
                $item->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
            } else if( $item->cantidad_esperada != $item->cantidad_entregada ) {
                $item->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
            } else {
                $item->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
            }

        	if ( $model->validate() ){
                if( $item->validate() ) {
                    
                    $session = Yii::$app->session;
        			if ( !$session->isActive ){ $session->open(); }

                    $dataInventory = $session->get( 'dataInventory' , $model );
                    $listItems = $session->get( 'listInventory' , [] );
                    $key = $item->producto . "" .$item->color . "" .$item->talla . "" .$item->tipo . "" .$item->detalle;

                    if ( array_key_exists ( $key , $listItems ) ) {
                        $itemDeLista = $listItems[$key];
                        if( !$itemDeLista->isNewRecord ){
                            if($itemDeLista->precio_unidad != $item->precio_unidad || $itemDeLista->precio_mayor != $item->precio_mayor){
                                if ( !array_key_exists ( $key+"_old" , $listItems ) ) {
                                    $itemDeLista->estado = TerminoSearch::estadoItemInventarioRemplazado()->codigo;
                                    $newItem = new ItemInventario() ;
                                    $newItem->load( [ "ItemInventario" => [
                                        "inventario" => $item->inventario,
                                        "producto" => $item->producto,
                                        "color" => $item->color,
                                        "talla" => $item->talla,
                                        "tipo" => $item->tipo,
                                        "detalle" => $item->detalle,
                                        "cantidad_esperada" => $item->cantidad_esperada + $itemDeLista->cantidad_esperada,
                                        "cantidad_defectuasa" => $item->cantidad_defectuasa + $itemDeLista->cantidad_defectuasa,
                                        "cantidad_entregada" => $item->cantidad_entregada + $itemDeLista->cantidad_entregada,
                                        "cantidad_actual" => $item->cantidad_actual,
                                        "precio_unidad" => $item->precio_unidad,
                                        "precio_mayor" => $item->precio_mayor,
                                        "estado" => $item->estado,
                                        "codigo_barras" => $item->codigo_barras,
                                    ] ] );
                                    $itemDeLista->cantidad_actual = 0;
                                    $listItems[ $key+"_old" ] = $itemDeLista ;
                                    $listItems[ $key ] = $newItem ;
                                } else {
                                    $itemOldd = $listItems[$key];
                                    $item->cantidad_esperada += $itemOldd->cantidad_esperada;
                                    $item->cantidad_defectuasa += $itemOldd->cantidad_defectuasa;
                                    $item->cantidad_entregada += $itemOldd->cantidad_entregada;
                                    $listItems[$key] = $item ;
                                }
                            } else {
                                $itemOldd = $listItems[$key];
                                $item->cantidad_esperada += $itemOldd->cantidad_esperada;
                                $item->cantidad_defectuasa += $itemOldd->cantidad_defectuasa;
                                $item->cantidad_entregada += $itemOldd->cantidad_entregada;
                                $listItems[$key] = $item ;
                            }
                        } else {
                            $itemOldd = $listItems[$key];
                            $item->cantidad_esperada += $itemOldd->cantidad_esperada;
                            $item->cantidad_defectuasa += $itemOldd->cantidad_defectuasa;
                            $item->cantidad_entregada += $itemOldd->cantidad_entregada;
                            $listItems[$key] = $item ;
                        }
                    } else {
                        $listItems[$key] = $item ;
                    }


                    $session->set( 'dataInventory' , $dataInventory );
                	$session->set( 'listInventory' , $listItems );

                	return [ 'success' => true , 'datos' => [ 'codeBar' => $item->codigo_barras , 'cantidad_esperada' => $item->cantidad_esperada , 'cantidad_defectuasa' => $item->cantidad_defectuasa , 'cantidad_entregada' => $item->cantidad_entregada , 'precio_unidad' => $item->precio_unidad , 'precio_mayor' => $item->precio_mayor ] ];
                } else {
                    return [ 'success' => false , 'mensaje' => $item->getErrors() ];
                }
            } else {
                return [ 'success' => false , 'mensaje' => "2" ];
            }
	    } else {
	    	return [ 'success' => false , 'mensaje' => "1" ];
	    }
    }
    
    public function actionRemoveItem()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $indice = Yii::$app->request->post( 'id' , null );
        if ( $indice != null ){
            $session = Yii::$app->session;
            if ( !$session->isActive ){ $session->open(); }
            $listItems = $session->get( 'listInventory' , [] );
            if ( array_key_exists ( $indice , $listItems ) ) {
                unset( $listItems[ $indice ] );
                $session->set( 'listInventory' , $listItems );
            }
        }
        return [ 'success' => true ];
    }
    
    public function actionSelectedItem(){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $indice = Yii::$app->request->post( 'id' , null );
        if ( $indice != null ){
            $session = Yii::$app->session;
            if ( !$session->isActive ){ $session->open(); }
            $listItems = $session->get( 'listInventory' , [] );
            if ( array_key_exists ( $indice , $listItems ) ) {
                $item = $listItems[ $indice ];
                return [ 'success' => true , 'datos' => [ 'codigo' => $item->codigo , 'codeBar' => $item->codigo_barras , 'cantidad_esperada' => $item->cantidad_esperada , 'cantidad_defectuasa' => $item->cantidad_defectuasa , 'cantidad_entregada' => $item->cantidad_entregada , 'precio_unidad' => $item->precio_unidad , 'precio_mayor' => $item->precio_mayor ] ];
            } else {
                return [ 'success' => false ];
            }
        }
    }

}
