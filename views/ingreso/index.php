<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\IngresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-index">
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="glyphicon glyphicon-search"></i>&nbsp;Filtrar por...
            </a>
            <?= Html::button('<i class="glyphicon glyphicon-plus"></i> Nuevo Ingreso', [ 'value' => Url::to( [ 'ingreso/create' ] ) ,'class' => 'btn btn-success' , 'id' => 'modalButton' ]) ?>
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
        'rowOptions' => function( $model ){
            if ( $model->estado0->key == 1 ) {
                return [ 'class' => 'success' ];
            } else if ( $model->estado0->key == 2 ){
                return [ 'class' => 'danger' ];
            } else if ( $model->estado0->key == 3 ){
                return [ 'class' => 'warning' ];
            } else if ( $model->estado0->key == 4 ){
                return [ 'class' => '' ];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'codigo',
            [
                'attribute' => 'fecha_cierre_caja',
                'format' => ['date', 'php:'.\Yii::$app->params['formatViewDate']]
            ],
            [
                'attribute' => 'fecha_llegada',
                'format' => ['date', 'php:'.\Yii::$app->params['formatViewDate']]
            ],
            'cantidad',
            'origen',
            [
                'attribute' => 'estado',
                'value' => 'estado0.termino',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'=>['class'=>'text text-center'],
                'template' => '{view} {update} {authorize} {not-authorize}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        if($model->estado0->key == 4){
                            return '';
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => $url,
                            ]);
                        }
                    },
                    'authorize' => function ($url, $model) {
                        if($model->estado0->key == 4){
                            return '';
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                'title' => Yii::t('app', 'Authorize'),
                            ]);
                        }
                    },
                    'not-authorize' => function ($url, $model) {
                        if($model->estado0->key == 4){
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                        'title' => Yii::t('app', 'NotAuthorize'),
                            ]);
                        } else {
                            return '';
                        }
                    },
                ],
            ],
        ],
    ]); ?>
</div>
