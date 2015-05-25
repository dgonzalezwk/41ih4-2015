<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-lg-3">
        <?= $form->field($model, 'nombre')->label(false) ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'estado')->label(false) ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'categoria')->label(false) ?>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            &nbsp;
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
