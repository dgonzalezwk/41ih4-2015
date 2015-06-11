<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\TerminoSearch;
use app\models\PuntoVentaSearch;
use app\models\UsuarioSearch;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Gasto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gasto-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'fecha')->widget(DatePicker::className(), [
            'language' => 'es',
            //'template' => '{input}',
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd MM yyyy',
                'startDate'=> '-70y',
                'endDate' => '-17y',
                'todayBtn' => true
            ]
        ]) ?>
        <?= $form->field($model, 'monto')->textInput(['maxlength' => 12]) ?>
        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 250]) ?>
        <?= $form->field($model, 'tipo_gasto')->dropDownList(ArrayHelper::map(TerminoSearch::searchTiposGasto(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion']) ?>
        <?= $form->field($model, 'usuario_autorizador')->dropDownList(ArrayHelper::map(UsuarioSearch::all(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion']) ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
