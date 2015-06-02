 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Horario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horario-form">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-4">
                <?=  TimePicker::widget([
                    'name' => "Horario[".$key."[[horario_apertura]]]",
                    'id' => "Horario-".$key."-horario_apertura",
                    'value' => '11:24 AM',
                    'pluginOptions' => [
                        'showSeconds' => true
                    ]
                ]);?>
            </div>
            <div class="col-lg-4">
                <?=  TimePicker::widget([
                    'name' => "Horario[".$key."[[hora_cierre]]]",
                    'id' => "Horario-".$key."-hora_cierre",
                    'value' => '11:24 AM',
                    'pluginOptions' => [
                        'showSeconds' => true
                    ]
                ]);?>
            </div>
            <div class="col-lg-4">
                <?=  TimePicker::widget([
                    'name' => "Horario[".$key."[[hora_max_cierre]]]",
                    'id' => "Horario-".$key."-hora_max_cierre",
                    'value' => '11:24 AM',
                    'pluginOptions' => [
                        'showSeconds' => true
                    ]
                ]);?>
            </div>
            <?= $form->field($model, 'dia')->hiddenInput()->label( false ) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
