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
<div class="punto-venta-index">
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="glyphicon glyphicon-search"></i>&nbsp;Filtrar por...
            </a>
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Nuevo punto de venta', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="well">
            <div class="row">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>
    <?php Pjax::begin()?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            #'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'ciudad', 
                'barrio',
                'direccion',
                //'codigo',     
                //'telefono',
                //'extension',
                // 'local',
                ['attribute' => 'estado','value' => function($model){
                    if($model->estado == 0){
                        return 'No activo';
                    } else {
                        return 'Activo';
                    }
                },'format'=>'raw'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions'=>['class'=>'text text-center'],
                    'template' => '{view} {update} {hablilitar} {desabilitar}',
                    'buttons' => [
                            'hablilitar' => function ($url, $model) {
                                if($model->estado == 0){
                                    return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                                'title' => Yii::t('app', 'hablilitar'),
                                    ]);
                                } else {
                                    return '';
                                }
                            },
                            'desabilitar' => function ($url, $model) {
                                if($model->estado == 1){
                                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                                'title' => Yii::t('app', 'desabilitar'),
                                    ]);
                                } else {
                                    return '';
                                }
                            },
                        ],
                ],
            ],
        ]); ?>
    <?php Pjax::end();?>
</div>