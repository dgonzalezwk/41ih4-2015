<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index">
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="glyphicon glyphicon-search"></i>&nbsp;Filtrar por...
            </a>
            <?= Html::a( $borrador ? '<i class="glyphicon glyphicon-play"></i> Seguir Con El Inventario' : '<i class="glyphicon glyphicon-plus"></i> Nuevo Inventario' , ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="well">
            <div class="row">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'codigo',
                'fecha',
                'punto_venta',
                'origen',
                'estado',
                'usuario_registro',
                'fecha_registro',
                'usuario_actualizador',
                'fecha_actualizacion',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
