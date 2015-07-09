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

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'fecha_cierre_caja') ?>

    <?= $form->field($model, 'fecha_llegada') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'corresponde')->checkbox() ?>

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

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
