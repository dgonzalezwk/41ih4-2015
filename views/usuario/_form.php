<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'identificacion')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'telefono')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'sexo')->textInput() ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'contrasena')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'rol')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
