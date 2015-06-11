<?php

use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\AccionSearch;
use app\models\TerminoSearch;
use app\models\RolSearch;
use dosamigos\datepicker\DatePicker;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="usuario-form">
    <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
            <div class="col-lg-6">
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
                        'startDate'=> '-70y',
                        'endDate' => '-17y',
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
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <h2>Permisos</h2>
                    <?php $itemsCollapse = []; ?>
                    <?php if ( isset($modulos) && is_array($modulos) ): ?>
                        <?php foreach ($modulos as $key => $modulo): ?>
                            <?php if ( is_array($modulo) ): ?>
                                <?php $temp = []; ?>
                                <?php $temp['label'] = $key; ?>
                                <?php $temp['content'] = Html::checkboxList( 'permisos' , $modulo['seleccionados'] , ArrayHelper::map( $modulo['permisos'] , 'codigo' , 'accion' ) , [  ] ); ?>
                                <?php array_push( $itemsCollapse , $temp );?>
                            <?php endif ?>

                        <?php endforeach ?>
                    <?php endif ?>
                    <?php
                        echo Collapse::widget([
                            'items' => $itemsCollapse,
                        ]);
                    ?>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Usuario asignado a:</h3>
                        </div>
                        <div class="panel-body">
                            <?= Html::checkboxList( 'puntos_venta_asignados' , null , ArrayHelper::map( null , 'codigo' , 'accion' ) , [ 'itemOptions' => ] ) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>