<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\TerminoSearch;
/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">
    <div class="row">
    <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-6">
            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options'=>[
                        'multiple'=>false
                    ],
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/site/file-upload']),
                        'uploadExtraData' => [
                            'album_id' => 20,
                            'cat_id' => 'Nature'
                        ],
                        'maxFileCount' => 1
                    ]
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
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Guardar Datos' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
