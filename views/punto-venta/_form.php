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
        <div class="col-lg-6">
        
            <?= $form->field($model, 'pais')->textInput(['maxlength' => 15]) ?>
            <?= $form->field($model, 'ciudad')->textInput(['maxlength' => 15]) ?>
            <?= $form->field($model, 'barrio')->textInput(['maxlength' => 25]) ?>
            <?= $form->field($model, 'direccion')->textInput(['maxlength' => 25]) ?>
            <?= $form->field($model, 'lugar')->textInput(['maxlength' => 25]) ?>
            <?= $form->field($model, 'local')->textInput(['maxlength' => 5]) ?>
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => 21]) ?>
            <?= $form->field($model, 'extension')->textInput(['maxlength' => 20]) ?>
            <?= $form->field($model, 'Whatsapp')->textInput(['maxlength' => 11]) ?>
            <?= $form->field($model, 'estado')->checkbox()->label('') ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar Datos' : 'Editar Datos', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>            
        </div>
        <div class="col-lg-6">
            <?php if ( isset($horarios) && is_array($horarios) ): ?>
                <?php $items = []; ?>
                <?php foreach ($horarios as $key => $horario): ?>
                    <?php $temp = []; ?>
                    <?php $temp['label'] = 'key'; ?>
                    <?php $temp['content'] = $this->render( '//horario/_form' , [ 'model' => $horario , "key" => $key ] ); ?>
                    <?php $temp['active'] = false; ?>
                    <?php $temp['options'] = 'key'; ?>
                    <?php array_push( $items , $temp );?>
                <?php endforeach ?>
                <?= 
                    Tabs::widget([
                        'items' => [
                            $items,
                        ],
                    ]);
                ?>
            <?php endif ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>