<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemFactura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-factura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'factura')->textInput() ?>

    <?= $form->field($model, 'producto')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
