<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = 'Registrar Ingreso';
$this->params['breadcrumbs'][] = ['label' => 'Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-create">
	<div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
	<div class="row">
	    <?= $this->render('_form', [ 'model' => $model ]) ?>
	</div>
</div>
