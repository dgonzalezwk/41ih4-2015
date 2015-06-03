<?php

use app\models\TerminoSearch;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">
    <div class="row">
    <?php $form = ActiveForm::begin([
        "method" => "post",
        "enableClientValidation" => true,
        "options" => ["enctype" => "multipart/form-data"],
     ]); ?>
        <div class="col-lg-6">
            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options'=>[
                        'multiple' => false ,
                    ],
                    'pluginOptions' => [
                        'initialPreview'=> $model->isNewRecord ? [] : [ Html::img( $model->imagen , [ "class" => "col-lg-12" ] ), ],
                        'showUpload' => false,
                        'browseLabel' => '',
                        'removeLabel' => '',
                        'mainClass' => 'input-group-sm'
                    ],
                ]);
            ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'nombre')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'descripcion')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'categoria')->dropDownList(ArrayHelper::map(TerminoSearch::searchCategoriasProducto(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'estado')->dropDownList(ArrayHelper::map(TerminoSearch::searchEstadosProducto(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion']) ?>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar Datos' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
