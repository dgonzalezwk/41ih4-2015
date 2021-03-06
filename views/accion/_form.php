<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Accion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-form">

    <?php $form = ActiveForm::begin([
    	'id' => 'form-action' ,
        'options' => ['data-pjax' => true ],
    ]); ?>

    <?= $form->field($model, 'accion')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'modulo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
