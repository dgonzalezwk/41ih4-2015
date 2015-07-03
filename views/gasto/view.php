<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AppDate;

/* @var $this yii\web\View */
/* @var $model app\models\Gasto */

$this->title = 'Detalles de gasto, Dia '.AppDate::stringToDate( $model->fecha , Yii::$app->params['formatViewDate'] );
$this->params['breadcrumbs'][] = ['label' => 'Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="gasto-view">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'codigo',
                'fecha',
                'monto',
                'usuario',
                'usuario_autorizador',
                'descripcion',
                'tipo_gasto',
                'punto_venta',
                'usuario_registro',
                'fecha_registro',
                'usuario_actualizacion',
                'fecha_actualizacion',
            ],
        ]) ?>
        <p>
            <?= Html::a('Editar Datos', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar Gasto', ['delete', 'id' => $model->codigo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>