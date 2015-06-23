<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\TerminoSearch;

/* @var $this yii\web\View */
/* @var $model app\models\GastoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gasto-search">
    <div class="row">
        <?php $form = ActiveForm::begin([ 'action' => ['index'] , 'method' => 'get' ]); ?>
            <div class="col-lg-3">
                <?= $form->field($model, 'fecha')->widget(DatePicker::className(), [
                    'language' => 'es',
                    'inline' => false,
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'dd MM yyyy',
                        'startDate'=> '-70y',
                        'endDate' => '-17y',
                        'todayBtn' => true
                    ]
                ])->label(false); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'usuario')->dropDownList(ArrayHelper::map(TerminoSearch::searchTiposGasto(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion'])->label(false) ?>
            </div>
            <div class="col-lg-3">
                <?php echo $form->field($model, 'tipo_gasto')->dropDownList(ArrayHelper::map(TerminoSearch::searchTiposGasto(), 'codigo', 'termino'),['prompt'=>'Seleccione Una Opcion'])->label(false) ?>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton('Limpiar Filtros', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
