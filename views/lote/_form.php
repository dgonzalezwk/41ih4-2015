<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'producto')->textInput() ?>

    <?= $form->field($model, 'color')->textInput() ?>

    <?= $form->field($model, 'talla')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'cantidad_entregada')->textInput() ?>

    <?= $form->field($model, 'cantidad_defectuasa')->textInput() ?>

    <?= $form->field($model, 'cantidad_esperada')->textInput() ?>

    <?= $form->field($model, 'precio_unidad')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'precio_mayor')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'origen')->textInput() ?>

    <?= $form->field($model, 'destino')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
