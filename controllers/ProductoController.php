<?php

namespace app\controllers;

use Yii;
use app\assets\AppDate;
use app\assets\AppAccessRule;
use app\models\Producto;
use app\models\ProductoSearch;
use app\models\TerminoSearch;
use yii\filters\AccessControl;
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
                       'actions' => [ 'index','view' ],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
                   [
                       'actions' => [ 'create','update','delete' ],
                       'allow' => true,
                       'roles' => ['?'],
                   ],
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
            
            // process uploaded image file instance
            $image = $model->uploadImage();
            //$image = UploadedFile::getInstance( $model, 'file' );
            //$ext = end((explode(".", $image->name)));
            //$model->imagen = Yii::$app->security->generateRandomString().".{$ext}";
            //$path =  Yii::$app->basePath . '/web/img/producto/'. $model->imagen;

            if($model->save()){
                // upload only if valid uploaded file instance found
                if ($image !== false) {
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->codigo]);
            } else {
                Yii::$app->getSession()->setFlash('error',  $model->getErrors() );
                return $this->render('create', [
                    'model' => $model,
                ]);
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
        // datos viejos
        $oldFile = $model->getImageFile();
        $oldImage = $model->imagen;

        if ( $model->load(Yii::$app->request->post()) ) {
            // process uploaded image file instance
            $image = $model->uploadImage();
            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->imagen = $oldImage;
            }
            if($model->save()){
                if ($image !== false && unlink($oldFile)) { // delete old and overwrite
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->codigo]);
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

    public function actionViewAll()
    {
        
        $code = Yii::$app->request->post( 'code' , null );
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ( $code == null ) {
            return [ 'success' => false ];
        } else if( strlen( $code ) < 14 ){
            return [ 'success' => false , 'mensajeError' => 'codigo de barras no valido.' ];
        } else {

            $producto = substr( $code , 11 , 3 );
            $model = $this->findModel( $producto );
            if ( $model != null ) {
                
                $talla = substr( $code , 4 , 2 );
                $color = substr( $code , 6 , 2 );
                $categoria = substr( $code , 8 , 2 );
                $detalle = substr( $code , 10 , 1 );

                $arrayData = [
                    'talla' => TerminoSearch::searchTallaProductoByKey( intval( $talla ) )->codigo ,
                    'color' => TerminoSearch::searchColorProductoByKey( intval( $color ) )->codigo ,
                    'tipo' => TerminoSearch::searchCategoriaProductoByKey( intval( $categoria ) )->codigo ,
                    'detalle' => TerminoSearch::searchDetalleProductoByKey( intval( $detalle ) )->codigo ,
                    'producto' => [
                        'codigo' => $model->codigo,
                        'nombre' => $model->nombre,
                        'descripcion' => $model->descripcion,
                        'estado' => $model->estado0->termino,
                        'categoria' => $model->categoria,
                        'imagen' => $model->getImageUrl(),
                        'cantidadActual' => 1
                    ],
                ];

                return [ 'success' => true , 'datos' => $arrayData ];
            } else {
                return [ 'success' => false , 'mensajeError' => 'producto no encontrado.' ];
            }
        }
    }

}
