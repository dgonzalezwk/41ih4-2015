<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemInventarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-inventario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'lote') ?>

    <?= $form->field($model, 'inventario') ?>

    <?= $form->field($model, 'cantidad_actual') ?>

    <?= $form->field($model, 'cantidad_reportada') ?>

    <?php // echo $form->field($model, 'cooresponde')->checkbox() ?>

    <?php // echo $form->field($model, 'igualado')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
