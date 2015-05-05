<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HorarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'horario_apertura') ?>

    <?= $form->field($model, 'hora_cierre') ?>

    <?= $form->field($model, 'hora_max_cierre') ?>

    <?= $form->field($model, 'dia') ?>

    <?php // echo $form->field($model, 'punto_venta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
