<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\InventarioSearch;

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
        'rowOptions' => function( $model ){
            if ( $model->estado0->key == 1 ) {
                return [ 'class' => 'success' ];
            } else if ( $model->estado0->key == 2 ){
                return [ 'class' => 'danger' ];
            } else if ( $model->estado0->key == 3 ){
                return [ 'class' => 'info' ];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'codigo',
                'fecha',
                [
                    'attribute' => 'estado',
                    'value' => 'estado0.termino',
                ],
                'fecha_registro',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'=>['class'=>'text text-center'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        if( $model->estado0->key == 2){
                            return '';
                        } else {
                            $borrador = InventarioSearch::searchInventarioBorrador();
                            if ( $borrador != null ) {
                                if ( $borrador->codigo == $model->codigo ) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => $url,
                                    ]);
                                }
                                return '';
                            } else {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => $url,
                                ]);
                            }
                        }
                    },
                    'delete' => function ($url, $model) {
                        if( $model->estado0->key == 3){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => $url,
                                'data' => [
                                    'confirm' => 'Esta seguro que desea eliminar el borrador?',
                                    'method' => 'post',
                                ],
                            ]);
                        } else {
                            return '';
                        }
                    }
                ],
            ],
        ],
    ]); ?>

</div>
