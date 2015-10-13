<?php

namespace app\controllers;

use Yii;
use app\assets\AppDate;
use app\assets\AppHandlingErrors;
use app\models\Promocion;
use app\models\PromocionSearch;
use app\models\PromocionPuntoVenta;
use app\models\PromocionPuntoVentaSearch;
use app\models\PuntoVentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper; 

/**
 * PromocionController implements the CRUD actions for Promocion model.
 */
class PromocionController extends Controller
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
        ];
    }

    /**
     * Lists all Promocion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PromocionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Promocion model.
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
     * Creates a new Promocion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Promocion();
        $puntosVentaSeleccionados = null;
        if ( $model->load( Yii::$app->request->post() ) ) {
            
            $stringDateStar = $model->fecha_inicio;
            $stringDateEnd = $model->fecha_fin;

            $model->fecha_inicio = AppDate::stringToDate($model->fecha_inicio , null );
            $model->fecha_fin = AppDate::stringToDate($model->fecha_fin , null );
            $puntosVentaSeleccionados = Yii::$app->request->post("puntos_venta_asignados" , null );

            try {
                $transaction = Yii::$app->db->beginTransaction();
                if( $model->save() ){
                    if ( is_array( $puntosVentaSeleccionados ) ) {
                        foreach ($puntosVentaSeleccionados as $idPuntoVenta) {
                            $promocionPuntoVenta = new PromocionPuntoVenta();
                            $promocionPuntoVenta->load( [ 'PromocionPuntoVenta' => [
                                    'promocion' => $model->codigo,
                                    'punto_venta' => $idPuntoVenta,
                                    'estado' => 1
                                ]
                            ] );
                            if ( !$promocionPuntoVenta->save() ) {
                                AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $promocionPuntoVenta->getErrors() ) );
                                $model->fecha_inicio = $stringDateStar;
                                $model->fecha_fin = $stringDateEnd;
                                $transaction->rollBack();
                                return $this->render('create', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
                            }
                        }
                    }
                    $transaction->commit();
                    AppHandlingErrors::setFlash( 'success' , 'Promocion guardada correctamente.' );                    
                    return $this->redirect(['view', 'id' => $model->codigo]);
                } else {
                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
                    return $this->render('create', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
                }
            } catch (Exception $e) {
                AppHandlingErrors::setFlash( 'danger' ,  $e->message );
                $model->fecha_inicio = $stringDateStar;
                $model->fecha_fin = $stringDateEnd;
                $transaction->rollBack();
                return $this->render('create', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
            }
        } else {
            return $this->render('create', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
        }
    }

    /**
     * Updates an existing Promocion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $puntosVentaSeleccionados = ArrayHelper::map( $model->getPromocionPuntoVentas() , 'codigo' , 'punto_venta' );;

       if ( $model->load( Yii::$app->request->post() ) ) {
            
            $stringDateStar = $model->fecha_inicio;
            $stringDateEnd = $model->fecha_fin;
            
            $model->fecha_inicio = AppDate::stringToDate($model->fecha_inicio , null );
            $model->fecha_fin = AppDate::stringToDate($model->fecha_fin , null );

            $transaction = Yii::$app->db->beginTransaction();
            $puntosVentaSeleccionados = Yii::$app->request->post("puntos_venta_asignados" , null );
            try {
                if( $model->save() ){
                    
                    $puntosVenta = PuntoVentaSearch::all();
                    foreach ( $puntosVenta as $puntoVenta ) {
                        if ( is_array( $puntosVentaSeleccionados ) && in_array( $puntoVenta->codigo , $puntosVentaSeleccionados ) ) {
                            if ( PromocionPuntoVentaSearch::isValido( $puntoVenta , $model ) ) {
                                $modelPromocionPuntoVenta = PromocionPuntoVentaSearch::puntoVentaPorPromocion( $puntoVenta , $model );
                                if (  !is_bool($modelPromocionPuntoVenta) &&  !$modelPromocionPuntoVenta->estado ) {
                                    $modelPromocionPuntoVenta->load([ 'PromocionPuntoVenta' => [
                                            'estado' => 1,
                                        ],
                                    ]);
                                    if ( !$modelPromocionPuntoVenta->save() ) {
                                        AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $modelPromocionPuntoVenta->getErrors() ) );
                                        $model->fecha_inicio = $stringDateStar;
                                        $model->fecha_fin = $stringDateEnd;
                                        $transaction->rollBack();
                                        return $this->render('update', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
                                    }
                                }
                            } else {
                                $modelPromocionPuntoVenta = new PromocionPuntoVenta();
                                $modelPromocionPuntoVenta->load( [ 'PromocionPuntoVenta' => [
                                        'promocion' => $model->codigo,
                                        'punto_venta' => $puntoVenta->codigo,
                                        'estado' => 1,
                                    ]
                                ] );
                                if ( !$modelPromocionPuntoVenta->save() ) {
                                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $modelPromocionPuntoVenta->getErrors() ) );
                                    $model->fecha_inicio = $stringDateStar;
                                    $model->fecha_fin = $stringDateEnd;
                                    $transaction->rollBack();
                                    return $this->render('update', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
                                }
                            }
                        } else if ( PromocionPuntoVentaSearch::isValido( $puntoVenta , $model ) ) {
                            $modelPromocionPuntoVenta = PromocionPuntoVentaSearch::puntoVentaPorPromocion( $puntoVenta , $model );
                            if ( !is_bool($modelPromocionPuntoVenta) && $modelPromocionPuntoVenta->estado ) {
                                $modelPromocionPuntoVenta->load([ 'PromocionPuntoVenta' => [
                                        'estado' => 0,
                                    ],
                                ]);
                                if ( !$modelPromocionPuntoVenta->save() ) {
                                    AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $modelPromocionPuntoVenta->getErrors() ) );
                                    $model->fecha_inicio = $stringDateStar;
                                    $model->fecha_fin = $stringDateEnd;
                                    $transaction->rollBack();
                                    return $this->render('update', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
                                }
                            }
                        }
                    }
                    $transaction->commit();
                    AppHandlingErrors::setFlash( 'success' , 'Promocion guardada correctamente.' );                    
                    return $this->redirect(['view', 'id' => $model->codigo]);
                }
            } catch (Exception $e) {
                AppHandlingErrors::setFlash( 'danger' ,  $e->message );
                $model->fecha_inicio = $stringDateStar;
                $model->fecha_fin = $stringDateEnd;
                $transaction->rollBack();
                return $this->render('update', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
            }
        } else {
            $model->fecha_inicio = AppDate::stringToDate( $model->fecha_inicio , Yii::$app->params['formatViewDate'] );
            $model->fecha_fin = AppDate::stringToDate( $model->fecha_fin , Yii::$app->params['formatViewDate'] );
            return $this->render('update', [ 'model' => $model , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ]);
        }
    }

    /**
     * Deletes an existing Promocion model.
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
     * Finds the Promocion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Promocion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promocion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
