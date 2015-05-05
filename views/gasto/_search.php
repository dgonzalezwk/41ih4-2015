<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gasto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'usuario') ?>

    <?= $form->field($model, 'usuario_autorizador') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'tipo_gasto') ?>

    <?php // echo $form->field($model, 'punto_venta') ?>

    <?php // echo $form->field($model, 'usuario_registro') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'usuario_actualizacion') ?>

    <?php // echo $form->field($model, 'fecha_actualizacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
