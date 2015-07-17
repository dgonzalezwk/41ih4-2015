<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'fecha_cierre_caja',
            'fecha_llegada',
            'cantidad',
            'corresponde:boolean',
            'usuario_pago',
            'igualado:boolean',
            'suma_anexada',
            'descripcion',
            'punto_venta',
            'origen',
            'destino',
            'usuario_registro',
            'fecha_registro',
            'usuario_actualizacion',
            'fecha_actualizacion',
        ],
    ]) ?>

</div>
