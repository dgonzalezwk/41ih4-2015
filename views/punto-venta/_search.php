<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVentaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="punto-venta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        #'fieldConfig' => [
            #'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
            #'labelOptions' => ['class' => 'col-lg-2 control-label'],
        #],
    ]); ?>
    <div class="col-lg-4">
        <?= $form->field($model, 'telefono') ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'extension') ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'ciudad') ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'barrio') ?>
    </div>
    <div class="col-lg-12 text text-center">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
