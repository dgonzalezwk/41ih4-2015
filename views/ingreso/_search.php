<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IngresoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingreso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    
    <div class="col-lg-3">
        <?= $form->field($model, 'fecha_cierre_caja')->label( false ) ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'fecha_llegada')->label( false ) ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'cantidad')->label( false ) ?>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    

    <?php // echo $form->field($model, 'usuario_pago') ?>

    <?php // echo $form->field($model, 'usuario_autorizador') ?>

    <?php // echo $form->field($model, 'igualado')->checkbox() ?>

    <?php // echo $form->field($model, 'suma_anexada') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'punto_venta') ?>

    <?php // echo $form->field($model, 'origen') ?>

    <?php // echo $form->field($model, 'destino') ?>

    <?php // echo $form->field($model, 'usuario_registro') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'usuario_actualizacion') ?>

    <?php // echo $form->field($model, 'fecha_actualizacion') ?>


    <?php ActiveForm::end(); ?>

</div>
