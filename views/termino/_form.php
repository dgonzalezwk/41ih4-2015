<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Termino */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="termino-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'termino')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'key')->textInput() ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
