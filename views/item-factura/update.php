<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemFactura */

$this->title = 'Update Item Factura: ' . ' ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Item Facturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-factura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
