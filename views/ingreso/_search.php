<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IngresoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingreso-search">
    <? Pjax::begin(); ?>
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'id' => 'search-ingreso' ,
            'options' => ['data-pjax' => true ],
        ]); ?>        
        <div class="col-lg-3">
            <?= $form->field($model, 'fecha_cierre_caja')->label( false ) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'fecha_llegada')->label( false ) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'cantidad')->label( false ) ?>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    <? Pjax::end(); ?>
</div>
