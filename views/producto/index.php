<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="producto-index">
        <?php Pjax::begin(['timeout' => 10000,]); ?>
        <div class="row">
            <h1><?= Html::encode($this->title) ?> | <?= Html::a('Crear Producto', ['create'], ['class' => 'btn btn-success']) ?> </h1> 
        </div>
        <div class="row">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="row">
            <div class="col-lg-11">
                
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'summary' => Html::tag('div', '<b>{count} - {totalCount}</b> de <b>{end}</b> productos' , [ "class" => "text text-center" ]),
                    'itemView' => function ($model, $key, $index, $widget) {
                        return #
                            Html::tag('div',
                                Html::tag('div',
                                    Html::a( 
                                        Html::tag('img', '', [ "class" => "img-responsive" , 'src' => Url::base() . '/img/producto/'. $model->imagen ]) 
                                    , [ 'view', 'id' => $model->codigo ] ).
                                    Html::tag('div',
                                        Html::tag('span', $model->estado0->termino , ['class' => 'pull-right text-muted small']) .
                                        Html::tag('h3', $model->nombre , [] ) .
                                        Html::tag('p', $model->descripcion , [] ) .
                                        Html::tag('p', Html::a( "Ver Detalles" , [ 'view', 'id' => $model->codigo ] , [ "class" => "btn btn-default" ] ) , [] ) 
                                    , [ "class" => "caption" ])
                                , [ "class" => "thumbnail" ])
                            , [ "class" => "col-lg-3 text text-center" ]);
                        #;
                    },
                ]) ?>
            </div>
        </div>
        <?php Pjax::end(); ?>
    </div>
</div>