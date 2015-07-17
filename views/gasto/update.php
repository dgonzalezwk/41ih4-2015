<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gasto */

$this->title = 'Editar Gasto: ' . $model->fecha . ' - No ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fecha . ' - No ' . $model->codigo , 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="gasto-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>