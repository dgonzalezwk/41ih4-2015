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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::button('Create Ingreso', [ 'value' => Url::to( [ 'ingreso/create' ] ) ,'class' => 'btn btn-success' , 'id' => 'modalButton' ]) ?>
    </p>
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
                'template' => '{view}&nbsp;{update}&nbsp;&nbsp;{authorize}&nbsp;{not-authorize}',
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
