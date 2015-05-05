<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemFacturaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Facturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-factura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Factura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'factura',
            'producto',
            'cantidad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
