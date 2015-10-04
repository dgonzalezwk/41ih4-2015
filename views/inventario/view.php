<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Inventario '.$model->fecha;
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-view">

    <div class="row title-window">
        <div class="col-lg-9">
            <h1><?= Html::encode($this->title) ?> 
            <?php if ( $model->estado0->key == 2 ): ?>
                <small class="text-color-danger">(No Activo)</small>
            <?php endif ?>
            <?php if ( $model->estado0->key == 1 ): ?>
                <small class="text-color-success">(Activo)</small>
            <?php endif ?>
            <?php if ( $model->estado0->key == 3 ): ?>
                <small class="text-color-info">(Borrador)</small>
            <?php endif ?>
            </h1>
        </div>
        <div class="col-lg-3 text text-right vcenter">
            <?php if ( $model->estado0->key == 1 ): ?>
                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Editar datos', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
            <?php endif ?>
            <?php if ( $model->estado0->key == 3 ): ?>
                <?= Html::a( '<i class="glyphicon glyphicon-play"></i> Seguir Con El Inventario' , ['update', 'id' => $model->codigo] , ['class' => 'btn btn-success']) ?>
            <?php endif ?>
            <?php /*echo Html::a('Eliminar Usuario', ['delete', 'id' => $model->codigo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);*/ ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="glyphicon glyphicon-th-list"></i> Datos del inventario</div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <p><label>Codigo De inventario:</label>&nbsp;<?= $model->codigo ?></p>
                        <p><label>Fecha:</label>&nbsp;<?= $model->fecha ?></p>
                        <p><label>Punto Venta:</label>&nbsp;<?= $model->puntoVenta->ciudad.'-'.$model->puntoVenta->barrio.'-'.$model->puntoVenta->direccion ?></p>
                    </div>
                    <div class="col-lg-6">
                        <p><label>Estado:</label>&nbsp;<?= $model->estado0->termino ?></p>
                        <p><label>Usuario que registra:</label>&nbsp;<?= $model->usuarioRegistro->nombre .' '. $model->usuarioRegistro->apellido ?></p>
                        <p><label>Fecha de registro:</label>&nbsp;<?= $model->fecha_registro ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="glyphicon glyphicon-th-list"></i> Productos</div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        
                    </div>
                    <div class="col-lg-12">
                        <?php $codigo = 0;?>
                        <?php foreach ($items as $listInventoryItem): ?>

                            <!-- si e codigo no es el mismo, cierro la tabla y los contenidores -->
                            <?php if ( $codigo != $listInventoryItem->producto && $codigo != 0 ): ?>
                                <?php $codigo = 0;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if ( $codigo == 0 ): ?>
                                <?php $codigo = $listInventoryItem->producto;?>
                                <div class="row item-list">
                                    <div class="col-lg-3">
                                        <img src="<?= $listInventoryItem->getProducto0()->one()->getImageUrl() ?>" class="img-rounded img-responsive" >
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row title-item-list">
                                                    <div class="col-lg-8 text text-left">
                                                        <h2><?= $listInventoryItem->getProducto0()->one()->nombre ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 text text-center">
                                                <label>Codigo&nbsp;</label>
                                                <p><?= $listInventoryItem->producto ?></p>
                                            </div>
                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Talla</th>
                                                            <th>Color</th>
                                                            <th>Tipo</th>
                                                            <th>Detalle</th>
                                                            <th>Cant Actual</th>
                                                            <th>Cant Defectuasa</th>
                                                            <th>Cant Entregada</th>
                                                            <th>$Unidad</th>
                                                            <th>$Mayor</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                
                            <?php endif ?>
                            <?php if ( $codigo == $listInventoryItem->producto ): ?>
                                                        <?php if ($listInventoryItem->estado0->key == 1): ?>
                                                            <tr class="success">
                                                        <?php endif ?>
                                                        <?php if ($listInventoryItem->estado0->key == 2): ?>
                                                            <tr class="warning">
                                                        <?php endif ?>
                                                        <?php if ($listInventoryItem->estado0->key == 3): ?>
                                                            <tr class="info">
                                                        <?php endif ?>
                                                        <?php if ($listInventoryItem->estado0->key == 4): ?>
                                                            <tr class="active">
                                                        <?php endif ?>
                                                        <?php if ($listInventoryItem->estado0->key == 5): ?>
                                                            <tr class="danger">
                                                        <?php endif ?>
                                                        
                                                            <td><p><?= $listInventoryItem->getTalla0()->one()->termino ?></p></td>
                                                            <td><p><?= $listInventoryItem->getColor0()->one()->termino ?></p></td>
                                                            <td><p><?= $listInventoryItem->getTipo0()->one()->termino ?></p></td>
                                                            <td><p><?= $listInventoryItem->getDetalle0()->one()->termino ?></p></td>
                                                            <td><p><?= $listInventoryItem->cantidad_actual ?></p></td>
                                                            <td><p><?= $listInventoryItem->cantidad_defectuasa ?></p></td>
                                                            <td><p><?= $listInventoryItem->cantidad_entregada ?></p></td>
                                                            <td><p>$<?= $listInventoryItem->precio_unidad ?></p></td>
                                                            <td><p>$<?= $listInventoryItem->precio_mayor ?></p></td>
                                                            <td>
                                                                <?php if ( $model->estado0->key == 3 || $model->estado0->key == 1 ): ?>
                                                                    <?php if ($listInventoryItem->estado0->key == 2): ?>
                                                                        <?= Html::a('<span class="glyphicon glyphicon-ok"></span>', 
                                                                            Url::to( [ 'item-inventario/eliminar-defectos' , 'id'=> $listInventoryItem->codigo ]),
                                                                            [ 'title' => 'Eliminar Defectos' ]
                                                                        )?>
                                                                    <?php endif ?>
                                                                    <?php if ($listInventoryItem->estado0->key == 3): ?>
                                                                        <?= Html::a('<span class="glyphicon glyphicon-ok"></span>', 
                                                                            Url::to( [ 'item-inventario/completar-cantidades' , 'id'=> $listInventoryItem->codigo ]),
                                                                            [ 'title' => 'Completar Cantidades' ]
                                                                        )?>
                                                                    <?php endif ?>
                                                                    <?php if ($listInventoryItem->estado0->key == 4): ?>
                                                                        <?= Html::a('<span class="glyphicon glyphicon-repeat"></span>', 
                                                                            Url::to( [ 'item-inventario/deshacer-remplazo' , 'id'=> $listInventoryItem->codigo ]),
                                                                            [ 'title' => 'Deshacer reemplazo' ]
                                                                        )?>
                                                                    <?php endif ?>
                                                                    <?php if ($listInventoryItem->estado0->key == 5): ?>
                                                                        <?= Html::a('<span class="glyphicon glyphicon-transfer"></span>', 
                                                                            Url::to( [ 'item-inventario/restaurar' , 'id'=> $listInventoryItem->codigo ]),
                                                                            [ 'title' => 'Restaurar item' ]
                                                                        )?>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            </td>
                                                        </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

