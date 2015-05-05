<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccionUsuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accion')->textInput() ?>

    <?= $form->field($model, 'usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
