<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PuntoVentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puntos De Venta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="punto-venta-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a('Crear punto de venta', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php Pjax::begin()?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'ciudad',
                'barrio',
                'direccion',
                //'codigo',     
                //'telefono',
                //'extension',
                // 'local',
                'estado:boolean',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end();?>
    </div>
</div>