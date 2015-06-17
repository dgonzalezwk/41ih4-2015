<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gasto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fecha') ?>
    <?= $form->field($model, 'usuario') ?>
    <?php echo $form->field($model, 'tipo_gasto') ?>
    <?php echo $form->field($model, 'punto_venta') ?>
    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpiar Filtros', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
