<?php

use app\models\TerminoSearch;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search text text-center">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-lg-4"></div>
    <div class="col-lg-3">
        <?= $form->field($model, 'categoria')->dropDownList(ArrayHelper::map(TerminoSearch::searchCategoriasProducto(), 'codigo', 'termino'),['prompt'=>'Seleccione una categoria'])->label(false) ?>
    </div>
    <div class="col-lg-2 text-center">
        <div class="form-group">
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            &nbsp;
            <?= Html::resetButton('Limpiar', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <div class="col-lg-3"></div>
    <?php ActiveForm::end(); ?>
</div>
