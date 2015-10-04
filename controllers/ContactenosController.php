<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PuntoVentaSearch;


class ContactenosController extends \yii\web\Controller
{
    public $layout = 'pagina_web';
    
    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            $searchModel = new PuntoVentaSearch();
            $dataProviderPuntosVenta = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('contact', [
                'model' => $model,
                'dataProviderPuntosVenta' => $dataProviderPuntosVenta,
            ]);
        }
    }

}
