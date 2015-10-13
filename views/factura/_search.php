<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'search-factura',
    ]); ?>
    <div class="col-lg-3">
        <?= $form->field($model, 'codigo') ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'usuario') ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'cliente') ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'punto_venta') ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'fecha') ?>
    </div>
        <?php // echo $form->field($model, 'metodo_pago') ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
