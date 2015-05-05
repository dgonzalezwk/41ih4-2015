<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemInventario */

$this->title = 'Update Item Inventario: ' . ' ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Item Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
