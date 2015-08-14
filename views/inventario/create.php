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
		<fieldset>
			<!--<label class="fs-title">Create your account</label>
			<label class="fs-subtitle">This is step 1</label>/-->
		    <div class="row">
		    	<?= $this->render('_form', [ 'model' => $model ] ) ?>
		    </div>
			<button type="button" class="next btn btn-success">Siguiente <i class="glyphicon glyphicon-chevron-right"></i> </button>
		</fieldset>
		<fieldset>
			<button type="button" class="previous btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</button>
			<button type="button" class="next btn btn-success">Siguiente <i class="glyphicon glyphicon-chevron-right"></i> </button>
		</fieldset>
		<fieldset>
			<button type="button" class="previous btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</button>
			<button type="submit" class="submit btn btn-success"><i class="glyphicon glyphicon-saved"></i> Submit</button>
		</fieldset>
	</div>
</div>
<?= $this->registerJsFile('@web/js/jquery.easing.compatibility.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
<?= $this->registerJsFile('@web/js/multi-step.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
<?= $this->registerJsFile('@web/js/jquery-ui.min.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>
