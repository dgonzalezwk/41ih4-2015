<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Termino */

$this->title = $model->termino;
$this->params['breadcrumbs'][] = ['label' => 'Terminos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="termino-view">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'codigo',
                'termino',
                'key',
                'categoria',
                'descripcion',
                'estado:boolean',
            ],
        ]) ?>
        <p>
            <?= Html::a('Editar Datos', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar Termino', ['delete', 'id' => $model->codigo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>