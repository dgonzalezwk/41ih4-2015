<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = 'Registrar Ingreso';
$this->params['breadcrumbs'][] = ['label' => 'Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-create">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
	    <?= $this->render('_form', [ 'model' => $model ]) ?>
	</div>
</div>
