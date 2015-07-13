<?php

use app\models\PuntoVentaSearch;
use app\models\TerminoSearch;
use app\models\UsuarioSearch;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingreso-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-6">
            <?= $form->field($model, 'tipo_ingreso')->dropDownList(ArrayHelper::map(TerminoSearch::estadosIngresos(), 'codigo', 'termino'),[ 'id' => 'combo-tipo-ingreso' , 'prompt' => 'Seleccione Una Opcion' ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'fecha_cierre_caja')->widget(DatePicker::classname(), [
                'language' => 'es',
                'removeButton' => false,
                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginEvents' => [
                    "show" => "function(e) {  }",
                    "hide" => "function(e) {  }",
                    "clearDate" => "function(e) {  }",
                    "changeDate" => "function(e) {
                        var sFecha = $( '#ingreso-fecha_cierre_caja' ).val();
                        $.post( '".Url::to( [ 'ingreso/validar-cierre' ] )."' , { fecha : sFecha } , function( data ){
                            if ( data.success ) {
                                $('#modalContent .alert').remove();
                                $('#modalContent #btn-save').removeAttr( 'disabled' );
                            } else {
                                $('#modalContent .alert').remove();
                                $('#modalContent').prepend('<div class=".'"alert alert-danger"'." role=".'"alert"'.">No puedes generar un cierre de caja</div>');
                                $('#modalContent #btn-save').attr( 'disabled' , 'disabled' );
                            }
                        } , 'json');
                    }",
                    "changeYear" => "function(e) {  }",
                    "changeMonth" => "function(e) {  }",
                ],
                'pluginOptions' => [
                    'orientation' => 'top right',
                    'autoclose' => true,
                    'format' => 'dd MM yyyy',
                    'startDate'=> '-7d',
                    'endDate' => '0d',
                    'todayBtn' => true
                ]
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'origen')->dropDownList(
                ArrayHelper::map( 
                    PuntoVentaSearch::allNotSelected() , 
                    'codigo', 
                    function($model, $defaultValue) {
                        return $model->ciudad.'-'.$model->barrio.'-'.$model->direccion;
                    }
                ),[ 'prompt' => 'Seleccione Una Opcion' ]) 
            ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'usuario_pago')->dropDownList(ArrayHelper::map( UsuarioSearch::allNotSession() , 'codigo', function ( $usuario) { return $usuario->nombre . ' ' . $usuario->apellido; }),['prompt'=>'Seleccione Una Opcion'])  ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'descripcion')->textArea(['rows' => '8', 'maxlength' => 250]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'cantidad')->textInput(['maxlength' => 12]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'cantidad_esperada')->textInput(['maxlength' => 12]) ?>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Registrar Ingreso' : 'Editar Datos', [ 'id' => 'btn-save' , 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->registerJsFile('@web/js/jsViewIngresos.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>