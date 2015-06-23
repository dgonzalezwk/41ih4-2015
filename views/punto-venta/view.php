<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */

$this->title = $model->barrio." ".$model->direccion;
$this->params['breadcrumbs'][] = ['label' => 'Punto Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punto-venta-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'telefono',
            'extension',
            'ciudad',
            'barrio',
            'direccion',
            'local',
            'estado:boolean',
        ],

    ]) ?>
    <p>
        <?= Html::a('Editar Datos', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar punto de venta', ['delete', 'id' => $model->codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>