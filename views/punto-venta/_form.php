<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="punto-venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => 15]) ?>
    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => 15]) ?>
    <?= $form->field($model, 'barrio')->textInput(['maxlength' => 25]) ?>
    <?= $form->field($model, 'direccion')->textInput(['maxlength' => 25]) ?>
    <?= $form->field($model, 'lugar')->textInput(['maxlength' => 25]) ?>
    <?= $form->field($model, 'local')->textInput(['maxlength' => 5]) ?>
    <?= $form->field($model, 'telefono')->textInput(['maxlength' => 21]) ?>
    <?= $form->field($model, 'extension')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'Whatsapp')->textInput(['maxlength' => 11]) ?>
    <?= $form->field($model, 'estado')->checkbox()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar Datos' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
