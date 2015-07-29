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
    ]); ?>
    <div class="col-lg-2">
        <?= $form->field($model, 'telefono')->label(false) ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'extension')->label(false) ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'ciudad')->label(false) ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'barrio')->label(false) ?>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
