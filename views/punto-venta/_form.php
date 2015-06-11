<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="punto-venta-form">
<?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 ">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'pais')->textInput([ "placeholder" => "Pais" ])->label(false) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'ciudad')->textInput([ "placeholder" => "Ciudad" ])->label(false) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'barrio')->textInput([ "placeholder" => "Barrio" ])->label(false) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'direccion')->textInput([ "placeholder" => "Direccion" ])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <?= $form->field($model, 'lugar')->textInput([ "placeholder" => "Lugar" ])->label(false) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?= $form->field($model, 'local')->textInput([ "placeholder" => "Local" ])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <?= $form->field($model, 'telefono')->textInput([ "placeholder" => "Telefono" ])->label(false) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?= $form->field($model, 'extension')->textInput([ "placeholder" => "Extension" ])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <?= $form->field($model, 'Whatsapp')->textInput([ "placeholder" => "Whatsapp" ])->label(false) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?= $form->field($model, 'estado')->checkbox() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
            
            <?php if ( isset($horarios) && is_array($horarios) ): ?>
                <?php $items = []; ?>
                <?php foreach ($horarios as $key => $horario): ?>
                    <?php $temp = []; ?>
                    <?php if ( $key == 0): ?>
                        <?php $temp['label'] = 'Lun'; ?>
                    <?php endif ?>
                    <?php if ( $key == 1): ?>
                        <?php $temp['label'] = 'Mar'; ?>
                    <?php endif ?>
                    <?php if ( $key == 2): ?>
                        <?php $temp['label'] = 'Mie'; ?>
                    <?php endif ?>
                    <?php if ( $key == 3): ?>
                        <?php $temp['label'] = 'Jue'; ?>
                    <?php endif ?>
                    <?php if ( $key == 4): ?>
                        <?php $temp['label'] = 'Vie'; ?>
                    <?php endif ?>
                    <?php if ( $key == 5): ?>
                        <?php $temp['label'] = 'Sab'; ?>    
                    <?php endif ?>
                    <?php if ( $key == 6): ?>
                        <?php $temp['label'] = 'Dom'; ?>    
                    <?php endif ?>
                    <?php $temp['content'] = $this->render( '//horario/_form' , [ 'model' => $horario , "key" => $key ] ); ?>
                    <?php $temp['active'] = false; ?>
                    <?php array_push( $items , $temp );?>
                <?php endforeach ?>
            <?php endif ?>
            <div class="row">
                <h2 class="text text-center">Horarios de la semana</h2>
                <?php 
                    echo Tabs::widget([
                        'navType' => 'nav nav-pills nav-stacked col-lg-2 col-md-2 col-sm-3 col-xs-3',
                        'itemOptions' => ["class" => "tab-content col-lg-10 col-md-10 col-sm-9 col-xs-9"], 
                        'items' => $items,
                    ])
                ?>
            </div>
            <div class="row text text-center">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Guardar Datos' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        
    </div>
    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>