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
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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
                    'template' => '{view}&nbsp;{update}&nbsp;{hablilitar}&nbsp;{desabilitar}',
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
        <p>
            <?= Html::a('Crear punto de venta', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php Pjax::end();?>
</div>