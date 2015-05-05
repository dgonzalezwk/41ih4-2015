<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemFactura */

$this->title = 'Create Item Factura';
$this->params['breadcrumbs'][] = ['label' => 'Item Facturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-factura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
