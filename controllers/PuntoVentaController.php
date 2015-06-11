<?php

namespace app\controllers;

use Yii;
use app\assets\AppAccessRule;
use app\assets\AppDate;
use app\assets\AppHandlingErrors;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\PuntoVenta;
use app\models\PuntoVentaSearch;
use app\models\Horario;
use app\models\Modulo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        $this->layout = 'administracion';

        
        $model = new PuntoVenta();

        $horarios = [];
        if ( $model->load( Yii::$app->request->post() ) ) {
            $transaction = Yii::$app->db->beginTransaction();
            if ( $model->save() ) {
                try {

                    $horarios = Yii::$app->request->post( "horarios" );
                    foreach ($horarios as $key => $dataHorario) {
                        $horario = new Horario();
                        if ( $horario->load( $dataHorario ) ) {

                            $horario->horario_apertura = AppDate::getTimeMeridanToTime( $horario->horario_apertura );
                            $horario->hora_cierre = AppDate::getTimeMeridanToTime( $horario->hora_cierre );
                            $horario->hora_max_cierre = AppDate::getTimeMeridanToTime( $horario->hora_max_cierre );
                            $horario->punto_venta = $model->codigo;
                            $horario->save();

                        } else {
                            AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $horario->getErrors() ) );
                            $horarios = $this->requestHorario( Yii::$app->request->post( "horarios" ) );
                            $transaction->rollBack();
                            return $this->render('create', [ 'model' => $model , "horarios" => $horarios ]);
                        }
                    }

                    $transaction->commit();
                    AppHandlingErrors::setFlash( 'success' , 'Datos del punto de venta guardados correctamente.' );                    
                    return $this->redirect(['view', 'id' => $model->codigo]);

                } catch (Exception $e) {
                    AppHandlingErrors::setFlash( 'danger' , $e->message );
                    $horarios = $this->requestHorario( Yii::$app->request->post( "horarios" ) );
                    $transaction->rollBack();
                    return $this->render('create', [ 'model' => $model , "horarios" => $horarios ]);
                }
            } else {
                AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
                $horarios = $this->requestHorario( Yii::$app->request->post( "horarios" ) );
                return $this->render('create', [ 'model' => $model , "horarios" => $horarios ]);
            }
        } else {
            for ($i=0; $i < 7 ; $i++) { 
                $horario = new Horario();
                $horario->dia = $i;
                array_push( $horarios , $horario);
            }
            return $this->render('create', [ 'model' => $model , "horarios" => $horarios ]);
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
        $horarios = [];

        if ( $model->load( Yii::$app->request->post() ) ) {
            $transaction = Yii::$app->db->beginTransaction();
            if ( $model->save() ) {
                try {

                    $horarios = Yii::$app->request->post( "horarios" );
                    foreach ( $model->horarios as $key => $horario ) {
                        if ( $horario->load( $horarios[ $key ] ) ) {
                            $horario->horario_apertura = AppDate::getTimeMeridanToTime( $horario->horario_apertura );
                            $horario->hora_cierre = AppDate::getTimeMeridanToTime( $horario->hora_cierre );
                            $horario->hora_max_cierre = AppDate::getTimeMeridanToTime( $horario->hora_max_cierre );
                            $horario->save();
                        } else {
                            AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $horario->getErrors() ) );
                            $horarios = $this->requestHorario( Yii::$app->request->post( "horarios" ) );
                            $transaction->rollBack();
                            return $this->render('update', [ 'model' => $model , "horarios" => $horarios ]);
                        }
                    }

                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->codigo]);

                } catch (Exception $e) {

                    AppHandlingErrors::setFlash( 'danger' , $e->message );
                    $horarios = $this->requestHorario( Yii::$app->request->post( "horarios" ) );;                    
                    $transaction->rollBack();
                    return $this->render('update', [ 'model' => $model , "horarios" => $horarios ]);

                }
            } else {

                AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
                $horarios = $this->requestHorario( Yii::$app->request->post( "horarios" ) );
                return $this->render('update', [ 'model' => $model , "horarios" => $horarios ]);

            }
        } else {

            return $this->render('update', [ 'model' => $model , "horarios" => $this->responseHorario( $model->horarios ) ]);

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

    private function responseHorario( $horarios )
    {
        foreach ($horarios as $key => $horario) {
            $horario->horario_apertura = AppDate::getTimeToTimeMeridan( $horario->horario_apertura );
            $horario->hora_cierre = AppDate::getTimeToTimeMeridan( $horario->hora_cierre );
            $horario->hora_max_cierre = AppDate::getTimeToTimeMeridan( $horario->hora_max_cierre );
        }
        return $horarios;
    }    

    private function requestHorario( $horariosRecibidos )
    {
        $horarios = [];
        foreach ($horariosRecibidos as $key => $dataHorario) {
            $horario = new Horario();
            if ( $horario->load( $dataHorario ) ) {  
                array_push( $horarios , $horario);
            }
        }
        return $horarios;
    }
}
