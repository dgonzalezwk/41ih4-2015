<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\TerminoSearch;
use app\models\PuntoVentaSearch;
use app\models\UsuarioSearch;
use dosamigos\datepicker\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Gasto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gasto-form">
    <?php Pjax::begin(); ?>        
        <?php $form = ActiveForm::begin([
            'id' => 'form-gasto' ,
            'options' => ['data-pjax' => true ],
        ]); ?>
            <div class="col-lg-6">
                <?= $form->field($model, 'fecha')->widget(DatePicker::className(), [
                    'language' => 'es',
                    //'template' => '{input}',
                    'inline' => false,
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'dd MM yyyy',
                        'startDate'=> '-7d',
                        'endDate' => '-0y',
                        'todayBtn' => true
                    ]
                ]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'monto')->textInput(['maxlength' => 12]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'descripcion')->textArea(['rows' => '6', 'maxlength' => 250]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'tipo_gasto')->dropDownList(ArrayHelper::map(TerminoSearch::searchTiposGasto(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion']) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'usuario_autorizador')->dropDownList(ArrayHelper::map(UsuarioSearch::autorizadoresPuntoVenta( Yii::$app->user->identity->getPuntoVentaSelected() ), 'codigo', function ( $usuario) { return $usuario->nombre . ' ' . $usuario->apellido; }),['prompt'=>'Seleccione Una Opcion']) ?>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Registrar Gasto' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
