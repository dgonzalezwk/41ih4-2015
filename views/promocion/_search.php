<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PromocionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'producto') ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'talla') ?>

    <?= $form->field($model, 'categoria') ?>

    <?php // echo $form->field($model, 'detalle') ?>

    <?php // echo $form->field($model, 'pocentaje') ?>

    <?php // echo $form->field($model, 'valor_fijo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
