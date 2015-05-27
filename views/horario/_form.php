<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Horario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horario-form">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-4">
                <?= $form->field($model, 'horario_apertura')->textInput()->label( false ) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'hora_cierre')->textInput()->label( false ) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'hora_max_cierre')->textInput()->label( false ) ?>
            </div>
            <?= $form->field($model, 'dia')->hiddenInput()->label( false ) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
