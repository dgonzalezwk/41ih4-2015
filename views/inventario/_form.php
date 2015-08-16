<?php

use app\models\PuntoVentaSearch;
use app\models\TerminoSearch;
use app\models\ItemInventario;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
?>
<fieldset>
    <!--<label class="fs-title">Create your account</label>
    <label class="fs-subtitle">This is step 1</label>/-->
    <?php $form = ActiveForm::begin([
        'id' => 'inventario-form',
    ]); ?>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                    'language' => 'es',
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
                <?= $form->field($model, 'origen')->dropDownList(
                    ArrayHelper::map( 
                        PuntoVentaSearch::allNotSelected() , 
                        'codigo', 
                        function($model, $defaultValue) {
                            return $model->ciudad.'-'.$model->barrio.'-'.$model->direccion;
                        }
                    ),[ 'prompt' => 'Seleccione Una Opcion' ]) 
                ?>
                <?= $form->field($model, 'codigoBarras')->textInput() 
                ?>
            </div>
            <div class="col-lg-8">
                <div class="panel-group" id="informacion-producto" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a role="button" data-toggle="collapse" data-parent="#informacion-producto" href="#collapse-producto-item" aria-expanded="true" aria-controls="collapseOne">
                                <i class="glyphicon glyphicon-picture"></i> Informacion de producto
                            </a>
                        </div>
                        <div id="collapse-producto-item" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="..." alt="...">
                                    </div>
                                    <div class="col-lg-8 text text-left">
                                        <div class="row">
                                            <p><label>Codigo:&nbsp;</label>xxx</p>
                                            <p><label>Nombre:&nbsp;</label>aaaaaaaaaaaaaaaaaaa</p>
                                            <p><label>Estado:&nbsp;</label>aaaaaaaaaaa</p>
                                        </div>
                                        <div class="row text text-left">
                                            <p><label>Descripcion:</label>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?= $this->render( '//item-inventario/_form' , [ 'model' => new ItemInventario() ] ); ?>
        </div>
    <?php ActiveForm::end(); ?>
    <br />
    <button type="button" class="next btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
    <button type="button" class="next btn btn-success">Siguiente <i class="glyphicon glyphicon-chevron-right"></i> </button>
</fieldset>
<fieldset>
    <button type="button" class="previous btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</button>
    <button type="button" class="next btn btn-success">Siguiente <i class="glyphicon glyphicon-chevron-right"></i> </button>
</fieldset>
<fieldset>
    <button type="button" class="previous btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</button>
    <button type="submit" class="submit btn btn-success"><i class="glyphicon glyphicon-saved"></i> Submit</button>
</fieldset>
