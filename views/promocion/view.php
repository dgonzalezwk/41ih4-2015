<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Promocion */

$this->title = 'Codigo ' . $model->codigo ;
$this->params['breadcrumbs'][] = ['label' => 'Promociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-view">
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Editar datos', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="row text text-center">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="thumbnail">
                <div class="caption">
                    <p>Producto:  <?= isset( $model->producto0 ) && isset( $model->producto0->nombre ) != null ? $model->producto0->nombre : 'No Especificado' ?></p>
                    <p>Color: <?= isset( $model->color0 ) && isset( $model->color0->termino ) != null ? $model->color0->termino : 'No Especificado' ?></p>
                    <p>Talla: <?= isset( $model->talla0 ) && isset( $model->talla0->termino ) != null ? $model->talla0->termino : 'No Especificado' ?></p>
                    <p>Categoria: <?= isset( $model->categoria0 ) && isset( $model->categoria0->termino ) != null ? $model->categoria0->termino : 'No Especificado' ?></p>
                    <p>Detalle: <?= isset( $model->detalle0 ) && isset( $model->detalle0->termino ) != null ? $model->detalle0->termino : 'No Especificado' ?></p>
                    <p>Valor Fijo: <?= $model->valor_fijo != null ? $model->valor_fijo : 'No Especificado' ?></p>
                    <p>Porcentaje: <?= $model->pocentaje != null ? $model->pocentaje : 'No Especificado' ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <div class="panel-group" id="puntosVenta" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a role="button" data-toggle="collapse" data-parent="#puntosVenta" href="#collapsePuntosVenta" aria-expanded="true" aria-controls="collapseOne">
                            <i class="glyphicon glyphicon-home"></i> Puntos de venta asignados
                        </a>
                    </div>
                    <div id="collapsePuntosVenta" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?php foreach ($model->promocionPuntoVentas as $puntoVenta ): ?>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <p><?= $puntoVenta->puntoVenta->ciudad." ".$puntoVenta->puntoVenta->barrio." ".$puntoVenta->puntoVenta->direccion ?></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ( $puntoVenta->estado ): ?>
                                            <span class="label label-success">Asignado</span>
                                        <?php else: ?>
                                            <span class="label label-danger">No asignado</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php /*DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'producto',
            'color',
            'talla',
            'categoria',
            'detalle',
            'pocentaje',
            'valor_fijo',
        ],
    ])*/ ?>

</div>
