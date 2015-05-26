<?php

namespace app\controllers;

use Yii;
use app\assets\AppDate;
use app\models\Producto;
use app\models\ProductoSearch;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
{
    public $layout = 'pagina_web'; 
    
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
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
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $this->layout = 'administracion';
        $model = new Producto();
        $model->usuarioCreate = Yii::$app->user->getId(); ;
        $model->usuarioMod = Yii::$app->user->getId(); ;
        
        if ( $model->load(Yii::$app->request->post()) ) {
            
            $image = UploadedFile::getInstance( $model, 'file' );
            $ext = end((explode(".", $image->name)));
            $model->imagen = Yii::$app->security->generateRandomString().".{$ext}";
            $path =  Yii::$app->basePath . '/web/img/producto/'. $model->imagen;

            if($model->save()){
                $image->saveAs($path);
                return $this->redirect(['view', 'id'=>$model->codigo]);
            } else {
                
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'administracion';
        $model = $this->findModel($id);
        $model->usuarioMod = Yii::$app->user->getId();
        if ( $model->load(Yii::$app->request->post()) ) {
            
            $image = UploadedFile::getInstance( $model, 'file' );
            if(!empty($image)){
                $path =  Url::base()."/img/producto/". $model->imagen;
            }

            if($model->save()){
                if(!empty($image)){
                    $image->saveAs($path);
                    return $this->redirect(['view', 'id'=>$model->codigo]);
                }
            } else {
                $model->imagen = Url::base()."/img/producto/". $model->imagen;
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            $model->imagen = Url::base()."/img/producto/". $model->imagen;
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing Producto model.
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
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
