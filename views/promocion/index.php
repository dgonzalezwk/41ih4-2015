<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromocionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promociones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-index">
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Nueva Promocion', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return # 
                Html::tag('div',
                        Html::tag('h3', 'Promocion #' . $model->codigo , [ 'class' => 'border-bottom' ] ).
                        Html::tag('div',
                            Html::tag('p',
                                Html::tag('label','Producto:&nbsp;' ,[]). Html::tag( 'span',  isset( $model->producto0 ) && isset( $model->producto0->nombre ) != null ? $model->producto0->nombre : 'No Especificado' , [] ) , 
                            []).
                            Html::tag('p',
                                Html::tag('label','Color:&nbsp;' ,[]). Html::tag( 'span', isset( $model->color0 ) && isset( $model->color0->termino ) != null ? $model->color0->termino : 'No Especificado' , [] ) , 
                            []).
                            Html::tag('p',
                                Html::tag('label','Talla:&nbsp;' ,[]). Html::tag( 'span', isset( $model->talla0 ) && isset( $model->talla0->termino ) != null ? $model->talla0->termino : 'No Especificado' , [] ) , 
                            []).
                            Html::tag('p',
                                Html::tag('label','Categoria:&nbsp;' ,[]). Html::tag( 'span', isset( $model->categoria0 ) && isset( $model->categoria0->termino ) != null ? $model->categoria0->termino : 'No Especificado' , [] ) , 
                            []).
                            Html::tag('p',
                                Html::tag('label','Detalle:&nbsp;' ,[]). Html::tag( 'span', isset( $model->detalle0 ) && isset( $model->detalle0->termino ) != null ? $model->detalle0->termino : 'No Especificado' , [] ) , 
                            []).
                            Html::tag('p',
                                Html::tag('label','Valor Fijo:&nbsp;' ,[]). Html::tag( 'span', $model->valor_fijo != null ? '-'.$model->valor_fijo : 'No Especificado' , [] ) , 
                            []).
                            Html::tag('p',
                                Html::tag('label','Porcentaje:&nbsp;' ,[]). Html::tag( 'span', $model->pocentaje != null ? '-'.$model->pocentaje : 'No Especificado' , [] ) , 
                            [])
                        , [ "class" => "caption border-bottom" ] ).
                        Html::tag('p', Html::a( "Ver Detalles" , [ 'view', 'id' => $model->codigo ] , [ "class" => "btn btn-default" ] ) , [] ) 
                , [ "class" => "col-lg-3 text text-center" ]);
            #;
        },
    ]) ?>

</div>
