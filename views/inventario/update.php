<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Update Inventario: ' . ' ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
	<!-- multistep form -->
	<div id="msform">
		<div class="row title-window">
	        <div class="col-lg-4 text text-left">
	            <h1><?= Html::encode($this->title) ?></h1>
	        </div>
	        <div class="col-lg-8 text text-right vcenter">
				<!-- progressbar -->
				<ul class="row text text-center" id="progressbar">
					<li class="active"><label>inventario</label></li>
					<li><label>listado de productos</label></li>
					<li><label>Consolidado</label></li>
				</ul>
	        </div>
	    </div>
		<!-- fieldsets -->
		<?= $this->render('_form', [ 'model' => $model , 'listInventory' => $listInventory ] ) ?>
	</div>
</div>
<?= $this->registerJsFile('@web/js/jquery.easing.compatibility.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
<?= $this->registerJsFile('@web/js/multi-step.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
<?= $this->registerJsFile('@web/js/jquery-ui.min.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>