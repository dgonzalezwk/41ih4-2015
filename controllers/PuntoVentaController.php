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
        return parent::beforeAction($action);
    } 

    /**
     * Lists all PuntoVenta models.
     * @return mixed
     */
    public function actionIndex()
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one();
        $keyAction = $modulo['codigo']."-PuntoVenta-view-*";

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
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one();
        $keyAction = $modulo['codigo']."-PuntoVenta-view-*";

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
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one();
        $keyAction = $modulo['codigo']."-PuntoVenta-create-*";

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
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one();
        $keyAction = $modulo['codigo']."-PuntoVenta-update-*";

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
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Puntos De venta'])->one();
        $keyAction = $modulo['codigo']."-PuntoVenta-delete-*";

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
