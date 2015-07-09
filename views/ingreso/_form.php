<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingreso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_cierre_caja')->textInput() ?>

    <?= $form->field($model, 'fecha_llegada')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'corresponde')->checkbox() ?>

    <?= $form->field($model, 'usuario_pago')->textInput() ?>

    <?= $form->field($model, 'usuario_autorizador')->textInput() ?>

    <?= $form->field($model, 'igualado')->checkbox() ?>

    <?= $form->field($model, 'suma_anexada')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'punto_venta')->textInput() ?>

    <?= $form->field($model, 'origen')->textInput() ?>

    <?= $form->field($model, 'destino')->textInput() ?>

    <?= $form->field($model, 'usuario_registro')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'usuario_actualizacion')->textInput() ?>

    <?= $form->field($model, 'fecha_actualizacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
