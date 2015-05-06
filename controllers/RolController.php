<?php

namespace app\controllers;

use Yii;
use app\models\Rol;
use app\models\RolSearch;
use app\models\Modulo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RolController implements the CRUD actions for Rol model.
 */
class RolController extends Controller
{
    public $layout = "administracion";
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
     * Lists all Rol models.
     * @return mixed
     */
    public function actionIndex()
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Rol-view-*";

        $searchModel = new RolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rol model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Rol-view-*";

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Rol-create-*";

        $model = new Rol();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Rol-update-*";

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
     * Deletes an existing Rol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        #este es el key de la accion aque se resaliazara a continuacion 
        #se debe busca en los permisos del usuario en sesion si el tiene permitido realizar esta accion.
        
        $modelModulo = new Modulo();
        $modulo = $modelModulo->find()->where(['modulo'=>'Usuarios'])->one();
        $keyAction = $modulo['codigo']."-Rol-delete-*";

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rol::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
