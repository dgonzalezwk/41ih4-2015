<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = 'Creacion de rol';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="rol-create">
	    <h1><?= Html::encode($this->title) ?></h1>
	    <?= $this->render('_form', ['model' => $model,]) ?>
	</div>
</div>