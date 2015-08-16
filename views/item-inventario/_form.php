<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\TerminoSearch;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\ItemInventario */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
        'id' => 'item-inventario-form',
        #'options' => ['class' => 'form-horizontal '],
        #'fieldConfig' => [
            #'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"row\">{error}</div>",
            #'labelOptions' => ['class' => 'col-lg-4 control-label'],
        #],
]); ?>
    <div class="panel-group" id="informacion-item" role="tablist" aria-multiselectable="true">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a role="button" data-toggle="collapse" data-parent="#informacion-item" href="#collapse-informacion-item" aria-expanded="true" aria-controls="collapseOne">
                        <i class="glyphicon glyphicon-barcode"></i> Informacion de codigo de barras
                    </a>
                </div>
                <div id="collapse-informacion-item" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <?= $form->field($model, 'talla')->dropDownList(
                            ArrayHelper::map(TerminoSearch::searchTiposGasto(),
                             'codigo', 'termino'
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                        <?= $form->field($model, 'color')->dropDownList(
                            ArrayHelper::map(TerminoSearch::searchTiposGasto(),
                             'codigo', 'termino'
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                        <?= $form->field($model, 'tipo')->dropDownList(
                            ArrayHelper::map(TerminoSearch::searchTiposGasto(),
                             'codigo', 'termino'
                            ),['prompt'=>'Seleccione Una Opcion']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a role="button" data-toggle="collapse" data-parent="#informacion-item" href="#collapse-cantidad-item" aria-expanded="true" aria-controls="collapseOne">
                        <i class="glyphicon glyphicon-piggy-bank"></i> Informacion de cantidades
                    </a>
                </div>
                <div id="collapse-cantidad-item" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'cantidad_esperada')->textInput([ 'type' => 'number' , 'min' => '1' , 'max' => '99999999' ]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'cantidad_defectuasa')->textInput([ 'type' => 'number' , 'min' => '1' , 'max' => '99999999' ]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'cantidad_entregada')->textInput([ 'type' => 'number' , 'min' => '1' , 'max' => '99999999' ]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'cantidad_actual')->textInput([ 'type' => 'number' , 'min' => '1' , 'max' => '99999999' , 'disabled' => 'didabled' ]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'precio_unidad')->widget(MaskMoney::classname(), [
                                'pluginOptions' => [
                                    'prefix' => '$ ',
                                    'suffix' => '',
                                    'allowNegative' => false
                                ]
                            ]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'precio_mayor')->widget(MaskMoney::classname(), [
                                'pluginOptions' => [
                                    'prefix' => '$ ',
                                    'suffix' => '',
                                    'allowNegative' => false
                                ]
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>