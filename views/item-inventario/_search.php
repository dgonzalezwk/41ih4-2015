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

    <?= $form->field($model, 'producto') ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'talla') ?>

    <?= $form->field($model, 'cantidad_esperada') ?>

    <?php // echo $form->field($model, 'cantidad_defectuasa') ?>

    <?php // echo $form->field($model, 'cantidad_entregada') ?>

    <?php // echo $form->field($model, 'cantidad_actual') ?>

    <?php // echo $form->field($model, 'precio_unidad') ?>

    <?php // echo $form->field($model, 'precio_mayor') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
