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
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );
        
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
        $session = Yii::$app->session;
        $model = new Inventario();
        $guardar = Yii::$app->request->get( 'guardar' , false );
        if( $guardar ){

            $transaction = Yii::$app->db->beginTransaction();
            try {
                
                $model = $session->get( 'dataInventory' , $model );
                $model->estado = TerminoSearch::estadoInventarioActivo()->codigo;;
                $model->fecha = AppDate::stringToDate($model->fecha , null );
                $model->fecha_registro = AppDate::date();
                $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
                $model->origen = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
                $model->codigoBarras = "00000000000000";
                
                $inventarios = InventarioSearch::searchInventariosActivos();
                foreach ( $inventarios as $inventario ) {
                    $inventario->estado = TerminoSearch::estadoInventarioNoActivo()->codigo;
                    if ( !$inventario->save() ) {
                        $transaction->rollBack();
                        AppHandlingErrors::setFlash( 'danger' , 'Error guardando el inventario.' );
                        return $this->render('update', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
                    }
                }

                if ( $model->save() && $model->validate() ) {
                    $listItems = $session->get( 'listInventory' , [] );
                    if ( count($listItems) > 0 ) {
                        foreach ($listItems as $key => $item) {
                            $item->inventario = $model->codigo;
                            $item->cantidad_actual += $item->cantidad_entregada; 
                            if ( !$item->save() ) {
                                $transaction->rollBack();
                                AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $item->getErrors() ) );
                                return $this->render('create', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
                            }
                        }
                        $transaction->commit();
                        $session->set( 'dataInventory' , null );
                        $session->set( 'listInventory' , null );
                        AppHandlingErrors::setFlash( 'success' , 'Datos del Usuario guardados correctamente.' );                    
                        $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                        return $this->redirect(['view', 'id' => $model->codigo]);
                    } else {
                        $transaction->rollBack();
                        AppHandlingErrors::setFlash( 'danger' , "El inventario esta vacio" );
                        $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                        return $this->render('create', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
                    }
                } else {
                    $transaction->rollBack();
                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
                    $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                    return $this->render('create', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                AppHandlingErrors::setFlash( 'danger' ,  $e->message );
                $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                return $this->render('create', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
            }

        } else {
            
            $model->fecha = AppDate::stringToDate( AppDate::date() , Yii::$app->params['formatViewDate'] );
            $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->origen = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model = $session->get( 'dataInventory' , $model );
            $model->codigoBarras = '';

            return $this->render('create', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
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
        $session = Yii::$app->session;
        $model = $this->findModel($id);
        $guardar = Yii::$app->request->get( 'guardar' , false );
        if( $guardar ){

            $transaction = Yii::$app->db->beginTransaction();
            try {

                $model = $session->get( 'dataInventory' , $model );
                $model->estado = TerminoSearch::estadoInventarioActivo()->codigo;
                $model->fecha = AppDate::stringToDate($model->fecha , null );
                $model->fecha_registro = AppDate::date();
                $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
                $model->origen = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
                $model->codigoBarras = "00000000000000";
            
                if ( $model->save() && $model->validate() ) {
                    $listItems = $session->get( 'listInventory' , [] );
                    if ( count($listItems) > 0 ) {
                        foreach ($listItems as $key => $item) {
                            if ( !$item->save() ) {
                                $transaction->rollBack();
                                AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $item->getErrors() ) );
                                return $this->render('update', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
                            }
                        }
                        $transaction->commit();
                        AppHandlingErrors::setFlash( 'success' , 'Datos del Usuario guardados correctamente.' );                    
                        $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                        return $this->redirect(['view', 'id' => $model->codigo]);
                    } else {
                        $transaction->rollBack();
                        AppHandlingErrors::setFlash( 'danger' , "El inventario esta vacio" );
                        $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                        return $this->render('update', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
                    }
                } else {
                    $transaction->rollBack();
                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
                    $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                    return $this->render('update', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
                }

            } catch (Exception $e) {
                $transaction->rollBack();
                AppHandlingErrors::setFlash( 'danger' ,  $e->message );
                $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
                return $this->render('update', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
            }
        } else {

            //$model = $session->set( 'dataInventory' , $model );
            //$listItems = $session->get( 'listInventory' , [] );
            //foreach ($variable as $key => $value) {
                //# code...
            //}
            //$key = $item->producto . "" .$item->color . "" .$item->talla . "" .$item->tipo . "" .$item->detalle;
            //if ( array_key_exists ( $key , $listItems ) ) {
                //$itemOldd = $listItems[$key];
                //$item->cantidad_esperada += $itemOldd->cantidad_esperada;
                //$item->cantidad_defectuasa += $itemOldd->cantidad_defectuasa;
                //$item->cantidad_entregada += $itemOldd->cantidad_entregada;
                //$listItems[$key] = $item ;
            //} else {
                //$listItems[$key] = $item ;
            //}
            //$session->set( 'listInventory' , $listItems );
            //$model->codigoBarras = '';

            return $this->render('update', [ 'model' => $model  , 'listInventory' => Yii::$app->session->get( 'listInventory' , [] ) ]);
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

    public function actionEditItem()
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
            }

            if ( $model->validate() ){
                if( $item->validate() ) {
                    
                    $session = Yii::$app->session;
                    if ( !$session->isActive ){ $session->open(); }

                    $dataInventory = $session->get( 'dataInventory' , $model );
                    $listItems = $session->get( 'listInventory' , [] );
                    $key = $item->producto . "" .$item->color . "" .$item->talla . "" .$item->tipo . "" .$item->detalle;

                    $itemDeLista = $listItems[$key];
                    if( !$itemDeLista->isNewRecord ){
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
                    } else {
                        $listItems[$key] = $item ;
                    }
                    $session->set( 'dataInventory' , $dataInventory );
                    $session->set( 'listInventory' , $listItems );

                    return [ 'success' => true , 'datos' => [ 'codeBar' => $item->codigo_barras , 'cantidad_esperada' => $item->cantidad_esperada , 'cantidad_defectuasa' => $item->cantidad_defectuasa , 'cantidad_entregada' => $item->cantidad_entregada , 'precio_unidad' => $item->precio_unidad , 'precio_mayor' => $item->precio_mayor ] ];
                } else {
                    return [ 'success' => false ];
                }
            } else {
                return [ 'success' => false ];
            }
        } else {
            return [ 'success' => false ];
        }
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
