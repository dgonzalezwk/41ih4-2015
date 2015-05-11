<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AccionSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Accion */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-6">
	<?= html::checkbox('AccionUsuario['+$model->accion+']', $checked = false, ['label'=> AccionSearch::accionesPorId( $model->accion )->accion ] ) ?>
	
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'accion')->checkbox(['label'=> AccionSearch::accionesPorId( $model->accion )->accion ]) ?>
	<?php ActiveForm::end(); ?>
</div>