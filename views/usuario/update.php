<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Editar Usuario: ' . ' ' . $model->nombre . " " . $model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre . " " . $model->apellido, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="container">
	<div class="usuario-update">
	    <h1><?= Html::encode($this->title) ?></h1>
	    <?= $this->render('_form', [ 'model' => $model , 'modulos'=> $modulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] ) ?>
	</div>
</div>