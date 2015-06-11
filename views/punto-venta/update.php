<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */

$this->title = 'Editar punto de venta: ' . ' ' . $model->barrio." ".$model->direccion;
$this->params['breadcrumbs'][] = ['label' => 'Puntos de venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->barrio." ".$model->direccion, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="container">
	<div class="punto-venta-update">
	    <h1><?= Html::encode($this->title) ?></h1>
	    <?= $this->render('_form', [ 'model' => $model, 'horarios' => $horarios]) ?>
	</div>
</div>