<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemInventario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-inventario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lote')->textInput() ?>

    <?= $form->field($model, 'inventario')->textInput() ?>

    <?= $form->field($model, 'cantidad_actual')->textInput() ?>

    <?= $form->field($model, 'cantidad_reportada')->textInput() ?>

    <?= $form->field($model, 'cooresponde')->checkbox() ?>

    <?= $form->field($model, 'igualado')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
