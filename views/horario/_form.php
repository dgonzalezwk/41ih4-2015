<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Horario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'horario_apertura')->textInput() ?>

    <?= $form->field($model, 'hora_cierre')->textInput() ?>

    <?= $form->field($model, 'hora_max_cierre')->textInput() ?>

    <?= $form->field($model, 'dia')->textInput() ?>

    <?= $form->field($model, 'punto_venta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
