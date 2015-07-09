<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = 'Create Ingreso';
$this->params['breadcrumbs'][] = ['label' => 'Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-create">
	<div class="row">
	    <h1><?= Html::encode($this->title) ?></h1>
	</div>
	<div class="row">
	    <?= $this->render('_form', [ 'model' => $model ]) ?>
	</div>
</div>
