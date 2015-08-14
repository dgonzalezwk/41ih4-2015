<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'usuario_registro')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?php ActiveForm::end(); ?>
    
</div>
