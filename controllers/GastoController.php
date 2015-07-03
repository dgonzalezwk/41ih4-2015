<?php

namespace app\controllers;

use Yii;
use app\assets\AppAccessRule;
use app\assets\AppDate;
use app\assets\AppHandlingErrors;
use app\models\Gasto;
use app\models\GastoSearch;
use app\models\Modulo;
use app\models\TerminoSearch;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * GastoController implements the CRUD actions for Gasto model.
 */
class GastoController extends Controller
{
    public $layout = 'administracion';
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
               'only' => [ 'index','view','create','update','delete' ],
               'rules' => [
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
     * Lists all Gasto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GastoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gasto model.
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
     * Creates a new Gasto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gasto();
        if ( $model->load(Yii::$app->request->post()) ) {
          $stringDate = $model->fecha;
          $model->fecha = AppDate::stringToDate($model->fecha , null );
          $model->usuario = Yii::$app->user->identity->codigo;
          $model->punto_venta = Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta;
          $model->usuario_registro = Yii::$app->user->identity->codigo;
          $model->estado = TerminoSearch::estadoGastoPorAutorizar()->codigo;
          if ( $model->save() ) {
            AppHandlingErrors::setFlash( 'success' , 'Datos guardados correctamente.' );
            return $this->redirect(['view', 'id' => $model->codigo]);
          } else {
            $model->fecha = $stringDate;
            AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
            return $this->render('create', [ 'model' => $model ]);
          }
        } else {
            return $this->render('create', [ 'model' => $model ]);
        }
    }

    /**
     * Updates an existing Gasto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( $model->load(Yii::$app->request->post()) ) {
          $stringDate = $model->fecha;
          $model->fecha = AppDate::stringToDate($model->fecha , null );
          $model->usuario_actualizacion = Yii::$app->user->identity->codigo;
          if ( $model->save() ) {
            AppHandlingErrors::setFlash( 'success' , 'Datos guardados correctamente.' );
            return $this->redirect(['view', 'id' => $model->codigo]);
          } else {
            $model->fecha = $stringDate;
            AppHandlingErrors::setFlash( 'danger' , AppHandlingErrors::getStringErrorModel( $model->getErrors() ) );
            return $this->render('update', [
                'model' => $model,
            ]);
          }
        } else {
            $model->fecha = AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gasto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionAuthorize( $id )
    {
        $model = $this->findModel($id);
        if ( $model->usuario_autorizador = Yii::$app->user->identity->codigo ) {
          $model->estado = TerminoSearch::estadoGastoAutorizado()->codigo;
          if ( $model->save() ) {
            AppHandlingErrors::setFlash( 'success' , 'El gasto a sido autorizado' );
            return $this->redirect(['index']);
          } else {
            AppHandlingErrors::setFlash( 'danger' , 'El gasto no se ha podido autorizar' );
            return $this->redirect(['index']);
          }
        } else {
          AppHandlingErrors::setFlash( 'danger' , 'Usted no puede autorizar este gasto' );
          return $this->redirect(['index']);
        }
    }

    public function actionNotAuthorize( $id )
    {
        $model = $this->findModel($id);
        if ( $model->usuario_autorizador = Yii::$app->user->identity->codigo ) {
          $model->estado = TerminoSearch::estadoGastoPorAutorizar()->codigo;
          if ( $model->save() ) {
            AppHandlingErrors::setFlash( 'success' , 'El gasto a sido autorizado' );
            return $this->redirect(['index']);
          } else {
            AppHandlingErrors::setFlash( 'danger' , 'El gasto no se ha podido autorizar' );
            return $this->redirect(['index']);
          }
        } else {
          AppHandlingErrors::setFlash( 'danger' , 'Usted no puede autorizar este gasto' );
          return $this->redirect(['index']);
        }
    }
    /**
     * Finds the Gasto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gasto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gasto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
