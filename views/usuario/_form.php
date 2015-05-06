<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\TerminoSearch;
use app\models\RolSearch;
use dosamigos\datepicker\DatePicker;
use dosamigos\datetimepicker\DateTimePicker;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">
    <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

        <?= $form->field($model, 'identificacion')->textInput() ?>
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => 30]) ?>
        <?= $form->field($model, 'apellido')->textInput(['maxlength' => 30]) ?>
        <?= $form->field($model, 'telefono')->textInput() ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => 30]) ?>
        <?= $form->field($model, 'fecha_nacimiento')->widget(DatePicker::className(), [
            'language' => 'es',
            //'template' => '{input}',
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd MM yyyy',
                'todayBtn' => true
            ]
        ]);?>
        <?= $form->field($model, 'sexo')->dropDownList(ArrayHelper::map(TerminoSearch::searchSexos(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion']) ?>
        <?= $form->field($model, 'usuario')->textInput(['maxlength' => 30]) ?>
        <?= $form->field($model, 'contrasena')->passwordInput(['maxlength' => 30]) ?>
        <?= $form->field($model, 'rol')->dropDownList(ArrayHelper::map(RolSearch::searchAll(), 'codigo', 'nombre'),['prompt'=>'Seleccione Una Opcion']) ?>
        <?= $form->field($model, 'estado')->dropDownList(ArrayHelper::map(TerminoSearch::searchEstadosUsuario(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion']) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Guardar Datos' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>