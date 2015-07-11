<?php

use app\models\PuntoVentaSearch;
use app\models\TerminoSearch;
use app\models\UsuarioSearch;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
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
                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose'=>true
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
                <?= Html::submitButton($model->isNewRecord ? 'Registrar Ingreso' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->registerJsFile('@web/js/jsViewIngresos.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>