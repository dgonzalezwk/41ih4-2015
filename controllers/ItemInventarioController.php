<?php

namespace app\controllers;

use Yii;
use app\models\ItemInventario;
use app\models\ItemInventarioSearch;
use app\models\ProductoSearch;
use app\models\TerminoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\assets\AppHandlingErrors;
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
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $item = $this->findModel($id);
        return [ 'success' => true , 'datos' => [ 'codigo' => $item->codigo , 'codeBar' => $item->codigo_barras , 'cantidad_esperada' => $item->cantidad_esperada , 'cantidad_defectuasa' => $item->cantidad_defectuasa , 'cantidad_entregada' => $item->cantidad_entregada , 'precio_unidad' => $item->precio_unidad , 'precio_mayor' => $item->precio_mayor , 'cantidad_actual' => $item->cantidad_actual ] ];
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

        
        $model->estado = TerminoSearch::estadoInventarioActivo()->codigo;
        if ( $model->load( Yii::$app->request->post() ) ) {

            $existe = ItemInventarioSearch::isExist( $model->producto , $model->color , $model->talla , $model->tipo , $model->detalle , $model->inventario );
            if ( $existe ) {
                $item = ItemInventarioSearch::obtenerItem( $model->producto , $model->color , $model->talla , $model->tipo , $model->detalle , $model->inventario );
                if($model->precio_unidad != $item->precio_unidad || $model->precio_mayor != $item->precio_mayor){
                    
                    $item->estado = TerminoSearch::estadoItemInventarioRemplazado()->codigo;

                    $model->cantidad_actual += ( $model->cantidad_entregada -  $model->cantidad_defectuasa );
                    $model->cantidad_esperada += $item->cantidad_esperada;
                    $model->cantidad_defectuasa += $item->cantidad_defectuasa;
                    $model->cantidad_entregada += $item->cantidad_entregada;

                    $item->cantidad_actual = 0;

                    if ( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa == 0 ){
                        $model->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
                    } else if( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa > 0 ) {
                        $model->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
                    } else if( $model->cantidad_esperada != $model->cantidad_entregada ) {
                        $model->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
                    }

                    if( $model->save() && $item->save() ){
                        return [ 'success' => true , 'datos' => [ 'codigoRemove' => $item->codigo, 'codigo' => $model->codigo , 'codeBar' => $model->codigo_barras , 'cantidad_esperada' => $model->cantidad_esperada , 'cantidad_defectuasa' => $model->cantidad_defectuasa , 'cantidad_entregada' => $model->cantidad_entregada , 'precio_unidad' => $model->precio_unidad , 'precio_mayor' => $model->precio_mayor ] ];
                    } else {
                        return [ 'success' => false ];
                    }
                } else {

                    $item->cantidad_esperada += $model->cantidad_esperada;
                    $item->cantidad_defectuasa += $model->cantidad_defectuasa;
                    $item->cantidad_entregada += $model->cantidad_entregada;
                    $item->cantidad_actual += ( $model->cantidad_entregada - $model->cantidad_defectuasa );

                    if ( $item->cantidad_esperada == $item->cantidad_entregada && $item->cantidad_defectuasa == 0 ){
                        $item->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
                    } else if( $item->cantidad_esperada == $item->cantidad_entregada && $item->cantidad_defectuasa > 0 ) {
                        $item->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
                    } else if( $item->cantidad_esperada != $item->cantidad_entregada ) {
                        $item->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
                    }

                    if( $item->save() ){
                        return [ 'success' => true , 'datos' => [ 'codigo' => $item->codigo , 'codeBar' => $item->codigo_barras , 'cantidad_esperada' => $item->cantidad_esperada , 'cantidad_defectuasa' => $item->cantidad_defectuasa , 'cantidad_entregada' => $item->cantidad_entregada , 'precio_unidad' => $item->precio_unidad , 'precio_mayor' => $item->precio_mayor ] ];
                    } else {
                        return [ 'success' => false ];
                    }
                }
            } else {
                if ( $model->load( Yii::$app->request->post() ) ){

                    $model->cantidad_actual += ( $model->cantidad_entregada -  $model->cantidad_defectuasa );

                    if( $model->save() ) {
                        return [ 'success' => true , 'datos' => [ 'codigo' => $model->codigo , 'codeBar' => $model->codigo_barras , 'cantidad_esperada' => $model->cantidad_esperada , 'cantidad_defectuasa' => $model->cantidad_defectuasa , 'cantidad_entregada' => $model->cantidad_entregada , 'precio_unidad' => $model->precio_unidad , 'precio_mayor' => $model->precio_mayor ] ];
                    } else {
                        return [ 'success' => false ];   
                    }
                } else {
                    return [ 'success' => false ];
                }
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
    public function actionUpdate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $modelTemp = new ItemInventario();
        $valores = Yii::$app->request->post( 'ItemInventario' , null );

        if ( $valores != null) {
            if( array_key_exists( 'codigo' , $valores ) ){
                $codigo = $valores['codigo'];
                $model = $this->findModel( $codigo );
                $cantidad_esperada = $model->cantidad_esperada;
                $cantidad_entregada = $model->cantidad_entregada;
                $cantidad_defectuasa = $model->cantidad_defectuasa;
                $cantidad_actual = $model->cantidad_actual;
                if( $model != null ){
                    if ( $model->load( Yii::$app->request->post() ) ) {
                        
                        if ( $cantidad_entregada != $model->cantidad_entregada ) {
                            if ( $cantidad_entregada < $model->cantidad_entregada ) {
                                $model->cantidad_actual += ( $model->cantidad_entregada - $cantidad_entregada );
                            } else {
                                $model->cantidad_actual -= ( $cantidad_entregada - $model->cantidad_entregada );
                            }
                        }

                        if ( $cantidad_defectuasa != $model->cantidad_defectuasa ) {
                            if ( $cantidad_defectuasa < $model->cantidad_defectuasa ) {
                                $model->cantidad_actual -= ( $model->cantidad_defectuasa - $cantidad_defectuasa );
                            } else {
                                $model->cantidad_actual += ( $cantidad_defectuasa - $model->cantidad_defectuasa );
                            }
                        }

                        if ( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa == 0 ){
                            $model->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
                        } else if( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa > 0 ) {
                            $model->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
                        } else if( $model->cantidad_esperada != $model->cantidad_entregada ) {
                            $model->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
                        }
                        if( $model->save() ){
                            return [ 'success' => true , 'datos' => [ 'codigo' => $model->codigo , 'codeBar' => $model->codigo_barras , 'cantidad_esperada' => $model->cantidad_esperada , 'cantidad_defectuasa' => $model->cantidad_defectuasa , 'cantidad_entregada' => $model->cantidad_entregada , 'precio_unidad' => $model->precio_unidad , 'precio_mayor' => $model->precio_mayor ] ];
                        } else {
                            return [ 'success' => false ];
                        }
                    } else {
                        return [ 'success' => false ];
                    }
                } else {
                    return [ 'success' => false ];
                }
            } else {
                return [ 'success' => false , 'mensaje' => 'hola'.$codigo ];
            }
        } else {
            return [ 'success' => false , 'mensaje' => 'hola'.$codigo ];
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
        $model = $this->findModel($id);
        $model->estado = TerminoSearch::estadoItemInventarioEliminado()->codigo;
        if( $model->save() ){
            return [ 'success' => true , 'datos' => [ 'codigo' => $id ] ];
        } else {
            return [ 'success' => false ];
        }
    }

    public function actionRestaurar($id)
    {
        $model = $this->findModel($id);
        $existe = ItemInventarioSearch::isExist( $model->producto , $model->color , $model->talla , $model->tipo , $model->detalle , $model->inventario );
        if ( $existe ) {
            AppHandlingErrors::setFlash( 'danger' , 'actualmente existe un producto en este inventario con las mismas caracteristicas, se recomienda eliminar dicho producto y restaurar el que corresponda.' );
            return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
        } else {
            if ( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa == 0 ){
                $model->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
            } else if( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa > 0 ) {
                $model->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
            } else if( $model->cantidad_esperada != $model->cantidad_entregada ) {
                $model->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
            }
            if ( $model->save() ) {
                AppHandlingErrors::setFlash( 'success' , 'Producto restaurado correctamente.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            } else {
                AppHandlingErrors::setFlash( 'danger' , 'El producto no se logro restaurar.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            }
        }
    }

    public function actionDeshacerRemplazo($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model = $this->findModel($id);
        try {
            $items = ItemInventarioSearch::obtenerItems( $model->producto , $model->color , $model->talla , $model->tipo , $model->detalle , $model->inventario );
            $cantidad = 0;
            foreach ($items as $item) {
                if( $item->estado != TerminoSearch::estadoItemInventarioRemplazado()->codigo ){
                    if ( $item->estado == TerminoSearch::estadoItemInventarioCompleto()->codigo || $item->estado == TerminoSearch::estadoItemInventarioDefectos()->codigo || $item->estado == TerminoSearch::estadoItemInventarioIncompleto()->codigo ) {
                        $item->estado = TerminoSearch::estadoItemInventarioRemplazado()->codigo;
                        if ( $item->cantidad_actual != 0 ) {
                            $model->cantidad_esperada = $item->cantidad_esperada;
                            $model->cantidad_defectuasa = $item->cantidad_defectuasa;
                            $model->cantidad_entregada = $item->cantidad_entregada;
                            $model->cantidad_actual = $item->cantidad_actual;
                            if ( !$item->save() ) {
                                AppHandlingErrors::setFlash( 'danger' , 'No se logro editar el estado de este producto en el inventario.' );
                                $transaction->rollBack();
                                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
                            }
                        }
                    }
                }
            }
            if ( $cantidad == 0 ) {
                $model->cantidad_actual = ProductoSearch::cantidadActual( $meodel->producto , $model->color , $model->talla , $model->tipo , $model->detalle );
            }
            if ( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa == 0 ){
                $model->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
            } else if( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa > 0 ) {
                $model->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
            } else if( $model->cantidad_esperada != $model->cantidad_entregada ) {
                $model->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
            }
            if ( $model->save() ) {
                $transaction->commit();
                AppHandlingErrors::setFlash( 'success' , 'Producto restaurado correctamente.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            } else {
                $transaction->rollBack();
                AppHandlingErrors::setFlash( 'danger' , 'No se logro editar el estado de este producto en el inventario.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            AppHandlingErrors::setFlash( 'danger' , 'No se logro editar el estado de este producto en el inventario.' );
            return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
        }
    }

    public function actionCompletarCantidades($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model = $this->findModel($id);
        try {
            
            $model->cantidad_entregada += $model->cantidad_esperada;
            $model->cantidad_actual += ( $model->cantidad_esperada - $model->cantidad_entregada );
                           
            if ( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa == 0 ){
                $model->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
            } else if( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa > 0 ) {
                $model->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
            } else if( $model->cantidad_esperada != $model->cantidad_entregada ) {
                $model->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
            }

            if ( $model->save() ) {
                $transaction->commit();
                AppHandlingErrors::setFlash( 'success' , 'Cantidades del producto editadas correctamente.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            } else {
                $transaction->rollBack();
                AppHandlingErrors::setFlash( 'danger' , 'No se lograron editar las cantidades de este producto en el inventario.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            AppHandlingErrors::setFlash( 'danger' , 'No se lograron editar las cantidades de este producto en el inventario.' );
            return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
        }
    }

    public function actionEliminarDefectos($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model = $this->findModel($id);
        try {
            
            $model->cantidad_actual += $model->cantidad_defectuasa;
            $model->cantidad_defectuasa = 0;
                           
            if ( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa == 0 ){
                $model->estado = TerminoSearch::estadoItemInventarioCompleto()->codigo;
            } else if( $model->cantidad_esperada == $model->cantidad_entregada && $model->cantidad_defectuasa > 0 ) {
                $model->estado = TerminoSearch::estadoItemInventarioDefectos()->codigo;
            } else if( $model->cantidad_esperada != $model->cantidad_entregada ) {
                $model->estado = TerminoSearch::estadoItemInventarioIncompleto()->codigo;
            }
            
            if ( $model->save() ) {
                $transaction->commit();
                AppHandlingErrors::setFlash( 'success' , 'Cantidades del producto editadas correctamente.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            } else {
                $transaction->rollBack();
                AppHandlingErrors::setFlash( 'danger' , 'No se lograron editar las cantidades de este producto en el inventario.' );
                return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            AppHandlingErrors::setFlash( 'danger' , 'No se lograron editar las cantidades de este producto en el inventario.' );
            return $this->redirect(['inventario/view', 'id' => $model->inventario ]);
        }
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
