<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GastoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gastos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="gasto-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>    
        </div>
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                #'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'fecha',
                        'format' => ['date', 'php:'.\Yii::$app->params['formatViewDate']]
                    ],
                    'monto',
                    [
                        'attribute' => 'tipo_gasto',
                        'value' => 'tipoGasto.termino',
                    ],
                    [
                        'attribute' => 'estado',
                        'value' => 'estado0.termino',
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}&nbsp;{update}&nbsp;{delete}&nbsp;{authorize}&nbsp;{not-authorize}',
                        'buttons' => [
                            'authorize' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                            'title' => Yii::t('app', 'Authorize'),
                                ]);
                            },
                            'not-authorize' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                            'title' => Yii::t('app', 'NotAuthorize'),
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
        <p>
            <?= Html::a('Registrar Gasto', ['create'], ['class' => 'btn btn-success']) ?>
        </p>    
    </div>
</div>