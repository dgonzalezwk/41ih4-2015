<?php

use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\AccionSearch;
use app\models\PuntoVentaSearch;
use app\models\TerminoSearch;
use app\models\RolSearch;
use dosamigos\datepicker\DatePicker;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="usuario-form">
    <div class="row">
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
                                <?php $temp['label'] = 'Permisos sobre '.$key; ?>
                                <?php $temp['content'] = Html::checkboxList( 'permisos' , $modulo['seleccionados'] , ArrayHelper::map( $modulo['permisos'] , 'codigo' , 'accion' ) , [ 'itemOptions' => [ 'labelOptions' => [ 'class' => 'col-lg-6' ] ] ] ); ?>
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
                    <h2>Asignado a:</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?= Html::checkboxList( 'puntos_venta_asignados' , $puntosVentaSeleccionados , ArrayHelper::map( PuntoVentaSearch::all() , 'codigo' ,  function ( $puntoVenta ) { return $puntoVenta->lugar . ' ' . $puntoVenta->direccion; } ) , [ 'itemOptions' => [ 'labelOptions' => [ 'class' => 'col-lg-6' ] ] ] ) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
    </div>
</div>