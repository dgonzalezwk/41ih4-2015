<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Nuevo Inventario';
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<!-- multistep form -->
	<div id="msform">
		<div class="row title-window">
	        <div class="col-lg-4 text text-left">
	            <h2><?= Html::encode($this->title) ?></h2>
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
		<?= $this->render('_form', [ 'model' => $model , 'itemModel' => $itemModel , 'listInventory' => $listInventory ] ) ?>
	</div>
</div>
<?= $this->registerJsFile('@web/js/jquery.easing.compatibility.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
<?= $this->registerJsFile('@web/js/multi-step.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
<?= $this->registerJsFile('@web/js/jquery-ui.min.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
