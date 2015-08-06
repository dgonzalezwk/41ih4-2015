<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\TerminoSearch;
use app\models\RolSearch;
use yii\widgets\ActiveForm;
use yii\widgets\pjax;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">
    <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form-usuario',
            'options' => ['data-pjax' => true ],
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
            <div class="col-lg-4">
                <?php echo $form->field($model, 'identificacion')->label( false ) ?>
            </div>
            <div class="col-lg-4">
                <?php echo $form->field($model, 'nombre')->label( false ) ?>
            </div>
            <div class="col-lg-4">
                <?php echo $form->field($model, 'usuario')->label( false ) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'sexo')->dropDownList(ArrayHelper::map(TerminoSearch::searchSexos(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion'])->label(false) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'rol')->dropDownList(ArrayHelper::map(RolSearch::searchAll(), 'codigo', 'nombre'),['prompt'=>'Seleccione Una Opcion'])->label(false) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'estado')->dropDownList(ArrayHelper::map(TerminoSearch::searchEstadosUsuario(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion'])->label(false) ?>
            </div>
            <div class="col-lg-12 text text-center">
                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    <? Pjax::end(); ?>
</div>