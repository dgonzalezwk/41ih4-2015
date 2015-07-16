<?php

namespace app\controllers;

use Yii;
use app\assets\AppAccessRule;
use app\assets\AppDate;
use app\assets\AppHandlingErrors;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Ingreso;
use app\models\IngresoSearch;
use app\models\TerminoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * IngresoController implements the CRUD actions for Ingreso model.
 */
class IngresoController extends Controller
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
            'access' => [
               'class' => AccessControl::className(),
               'ruleConfig' => [
                   'class' => AppAccessRule::className(),
               ],
               'only' => [ 'index','view','create','update','delete' ],
               'rules' => [
                   [
                       'actions' => [ 'index','view' ],
                       'allow' => true,
                       'roles' => ["Ingreso-view-*"],
                   ],
                   [
                       'actions' => [ 'create' ],
                       'allow' => true,
                       'roles' => ["Ingreso-create-*"],
                   ],
                   [
                       'actions' => [ 'update' ],
                       'allow' => true,
                       'roles' => ["Ingreso-update-*"],
                   ],
                   [
                       'actions' => [ 'delete' ],
                       'allow' => true,
                       'roles' => ["Ingreso-delete-*"],
                   ],

               ],
            ],
        ];
    }

    /**
     * Lists all Ingreso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngresoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingreso model.
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
     * Creates a new Ingreso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ingreso();
        if ( $model->load( Yii::$app->request->post() ) ) {

            $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->destino = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->usuario_registro = Yii::$app->user->identity->codigo;
            $model->fecha_llegada = AppDate::date();

            $model->corresponde = 0;
            $model->igualado = 0;
            $model->suma_anexada = 0;

            $intCantidad = intval( $model->cantidad );
            $intCantidad_esperada = intval( $model->cantidad_esperada );
              
            if ( $intCantidad == $intCantidad_esperada ) {
                $model->corresponde = 1;
                $model->igualado = 1;
                $model->estado = TerminoSearch::estadoIngresoCorrecto()->codigo;
            } else if ( $intCantidad > $intCantidad_esperada ) {
                $model->corresponde = 1;
                $model->igualado = 1;
                $model->suma_anexada = ( $intCantidad - $intCantidad_esperada );
                $model->estado = TerminoSearch::estadoIngresoMayor()->codigo;
            } else if ( $intCantidad < $intCantidad_esperada ) {
                $model->estado = TerminoSearch::estadoIngresoMenor()->codigo;
            }

            if ( $model->save() ){
                return $this->redirect([ 'view' , 'id' => $model->codigo ]);
            } else {
                return $this->renderAjax('create', [ 'model' => $model ] );
            }
        } else {
            return $this->renderAjax( 'create' , [ 'model' => $model ]);
        }
    }

    /**
     * Updates an existing Ingreso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( $model->load( Yii::$app->request->post() ) ) {

            $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->destino = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
            $model->usuario_registro = Yii::$app->user->identity->codigo;
            $model->fecha_llegada = AppDate::date();

            $model->corresponde = 0;
            $model->igualado = 0;
            $model->suma_anexada = 0;

            $intCantidad = intval( $model->cantidad );
            $intCantidad_esperada = intval( $model->cantidad_esperada );
              
            if ( $intCantidad == $intCantidad_esperada ) {
                $model->corresponde = 1;
                $model->igualado = 1;
                $model->estado = TerminoSearch::estadoIngresoCorrecto()->codigo;
            } else if ( $intCantidad > $intCantidad_esperada ) {
                $model->corresponde = 1;
                $model->igualado = 1;
                $model->suma_anexada = ( $intCantidad - $intCantidad_esperada );
                $model->estado = TerminoSearch::estadoIngresoMayor()->codigo;
            } else if ( $intCantidad < $intCantidad_esperada ) {
                $model->estado = TerminoSearch::estadoIngresoMenor()->codigo;
            }

            if ( $model->save() ){
                return $this->redirect([ 'view' , 'id' => $model->codigo ]);
            } else {
                return $this->renderAjax('create', [ 'model' => $model ] );
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ingreso model.
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
     * Finds the Ingreso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingreso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingreso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing Ingreso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionValidarCierre()
    {
        Yii::$app->response->format = 'json';
        $fecha = Yii::$app->request->post( 'fecha' , null );
        if ( $fecha != null && $fecha != '' ) {
          $ingresos = IngresoSearch::byFechaCierreCaja( $fecha );
          if ( count( $ingresos ) > 0 ) {
            return [ "success" => false ];
          } else {
            $datos = Yii::$app->user->identity->getPuntoVentaSelected()->puntoVenta->ventasByFecha( $fecha );
            if ( $datos != null ) {
              if ( isset( $datos['valor'] ) && $datos['valor'] != "" ) {
                return [ "success" => true , 'valor' => $datos['valor'] ];
              } else {
                return [ "success" => false ];
              }
            } else {
              return [ "success" => false ];
            }
          }
        } else {
          return [ "success" => false ];
        }
    }
}
