 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Horario */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $dia = ''; ?>
<?php if ( $key == 0): ?>
    <?php $dia = 'Lunes'; ?>
<?php endif ?>
<?php if ( $key == 1): ?>
    <?php $dia = 'Martes'; ?>
<?php endif ?>
<?php if ( $key == 2): ?>
    <?php $dia = 'Miercoles'; ?>
<?php endif ?>
<?php if ( $key == 3): ?>
    <?php $dia = 'Jueves'; ?>
<?php endif ?>
<?php if ( $key == 4): ?>
    <?php $dia = 'Viernes'; ?>
<?php endif ?>
<?php if ( $key == 5): ?>
    <?php $dia = 'Sabado'; ?>    
<?php endif ?>
<?php if ( $key == 6): ?>
    <?php $dia = 'Domingo'; ?>    
<?php endif ?>
<div class="horario-form">
    <div class="row">
        <h3 class="text text-center">Dia <?= $dia?></h3>
        <?= Html::hiddenInput( "horarios[".$key."][Horario][codigo]" , $model->codigo ) ?>
        <div class="col-lg-12">
            <label>Hora de apertura</label>
            <?=  TimePicker::widget([
                'name' => "horarios[".$key."][Horario][horario_apertura]",
                'id' => "Horario-".$key."-horario_apertura",
                'value' => $model->horario_apertura,
                'pluginOptions' => [
                    'defaultTime' => '8:00 AM',
                    'showSeconds' => false,
                    'showMeridian' => true,
                    'minuteStep' => 30,
                ]
            ]);?>
        </div>
        <div class="col-lg-12">
            <label>Hora de cierre</label>
            <?=  TimePicker::widget([
                'name' => "horarios[".$key."][Horario][hora_cierre]",
                'id' => "Horario-".$key."-hora_cierre",
                'value' => $model->hora_cierre,
                'pluginOptions' => [
                    'defaultTime' => '6:00 PM',
                    'showSeconds' => false,
                    'showMeridian' => true,
                    'minuteStep' => 30,
                ]
            ]);?>
        </div>
        <div class="col-lg-12">
            <label>Hora maxima de cierre</label>
            <?=  TimePicker::widget([
                'name' => "horarios[".$key."][Horario][hora_max_cierre]",
                'id' => "Horario-".$key."-hora_max_cierre",
                'value' => $model->hora_max_cierre,
                'pluginOptions' => [
                    'defaultTime' => '6:00 PM',
                    'showSeconds' => false,
                    'showMeridian' => true,
                    'minuteStep' => 30,
                ]
            ]);?>
        </div>
        <?= Html::hiddenInput( "horarios[".$key."][Horario][dia]" , $model->dia ) ?>
    </div>
</div>
