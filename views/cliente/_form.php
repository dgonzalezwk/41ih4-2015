<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numero_identificacion')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'sexo')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'telefono')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'contrasena')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

    <?= $form->field($model, 'info')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
