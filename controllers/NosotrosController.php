<?php

namespace app\controllers;

class NosotrosController extends \yii\web\Controller
{
	public $layout = 'pagina_web';
	
    public function actionIndex()
    {
        return $this->render('index');
    }

}
