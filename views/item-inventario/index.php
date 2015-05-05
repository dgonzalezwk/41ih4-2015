<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemInventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Inventarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Inventario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'lote',
            'inventario',
            'cantidad_actual',
            'cantidad_reportada',
            // 'cooresponde:boolean',
            // 'igualado:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
