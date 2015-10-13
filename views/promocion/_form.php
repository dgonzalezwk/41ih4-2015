<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\TerminoSearch;
use app\models\ProductoSearch;
use app\models\PuntoVentaSearch;
use app\models\ItemInventario;
use app\assets\AppDate;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\models\Promocion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocion-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-5">
                <!--<div class="row">
                    <div class="col-lg-12 text text-center">
                        <h6>Listado de productos afectados</h6>
                    </div>
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text text-center">Producto</th>
                                    <th class="text text-center">Cantidad</th>
                                    <th class="text text-center">Precio Mayor</th>
                                    <th class="text text-center">Precio Unidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>-->
                <h4>Asignado a:</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= Html::checkboxList( 'puntos_venta_asignados' , $puntosVentaSeleccionados , ArrayHelper::map( PuntoVentaSearch::all() , 'codigo' ,  function ( $puntoVenta ) { return $puntoVenta->lugar . ' ' . $puntoVenta->direccion; } ) , [ 'itemOptions' => [ 'labelOptions' => [ 'class' => 'col-lg-12' ] ] ] ) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
                            'language' => 'es',
                            'value' => AppDate::date(),
                            'removeButton' => false,
                            'options' => ['placeholder' => ''],
                            'pluginEvents' => [
                                "show" => "function(e) {  }","hide" => "function(e) {  }","clearDate" => "function(e) {  }","changeDate" => "function(e) {  }","changeYear" => "function(e) {  }","changeMonth" => "function(e) {  }",
                            ],
                            'pluginOptions' => [
                                'orientation' => 'top left',
                                'autoclose' => true,
                                'format' => 'dd MM yyyy',
                                'startDate'=> '-7d',
                                'endDate' => '0d',
                                'todayBtn' => true
                            ]
                        ]) ?> 
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
                            'language' => 'es',
                            'value' => AppDate::date(),
                            'removeButton' => false,
                            'options' => ['placeholder' => ''],
                            'pluginEvents' => [
                                "show" => "function(e) {  }","hide" => "function(e) {  }","clearDate" => "function(e) {  }","changeDate" => "function(e) {  }","changeYear" => "function(e) {  }","changeMonth" => "function(e) {  }",
                            ],
                            'pluginOptions' => [
                                'orientation' => 'top left',
                                'autoclose' => true,
                                'format' => 'dd MM yyyy',
                                'startDate'=> '-7d',
                                'endDate' => '0d',
                                'todayBtn' => true
                            ]
                        ]) ?> 
                    </div>   
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="codigo_barras">Codigo de barras</label>
                            <input type="text" id="codigo_barras" class="form-control" name="codigo_barras">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'color')->dropDownList(
                            ArrayHelper::map(TerminoSearch::searchColoresProducto(),
                             'codigo', 'termino'
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'categoria')->dropDownList(
                            ArrayHelper::map(TerminoSearch::searchCategoriasProducto(),
                             'codigo', 'termino'
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'detalle')->dropDownList(
                            ArrayHelper::map(TerminoSearch::searchDetallesProducto(),
                             'codigo', 'termino'
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'talla')->dropDownList(
                            ArrayHelper::map(TerminoSearch::searchTallasProducto(),
                             'codigo',
                             function($model, $defaultValue) {
                                return 'Talla '.$model->key.' - '.$model->termino ;
                            }
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'producto')->dropDownList(
                            ArrayHelper::map(ProductoSearch::all(),
                             'codigo',
                             function($model, $defaultValue) {
                                return $model->nombre ;
                            }
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'pocentaje')->textInput() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'valor_fijo')->widget(MaskMoney::classname(), [
                            'pluginOptions' => [
                                'prefix' => '$ ',
                                'suffix' => '',
                                'allowNegative' => false
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="row text text-center">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Guardar Promocion' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
