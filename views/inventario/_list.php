<?php

use yii\helpers\Html;

?>
<?php if ( count( $listInventory ) == 0 ): ?>
<div class="col-lg-12 text text-center">
        <p>El inventario no tiene productos actualmente.</p>
    </div>
<?php endif ?>
<?php foreach ($listInventory as $listInventoryItem): ?>
    <div class="row item-list <?= $listInventoryItem->codigo ?>">
        <div class="col-lg-3">
            <img src="<?= $listInventoryItem->getProducto0()->one()->getImageUrl() ?>" class="img-rounded img-responsive" >
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row title-item-list">
                        <div class="col-lg-6 text text-left">
                            <h3><?= $listInventoryItem->getProducto0()->one()->nombre ?></h3>
                        </div>
                        <div class="col-lg-6 text text-right">
                            <p>
                                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['item-inventario/view' , 'id' => $listInventoryItem->codigo ], ['class' => 'btn btn-warning' ,'onclick' => "selectedItemList( $(this) , event );" ]) ?>
                                <?= Html::a('<i class="glyphicon glyphicon-remove"></i>', ['item-inventario/delete', 'id' => $listInventoryItem->codigo], ['class' => 'btn btn-danger'  , 'onclick' => "removeItem( $(this) , event )" ]) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label>Codigo&nbsp;</label>
                    <p><?= $listInventoryItem->producto ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Talla&nbsp;</label>
                    <p><?= $listInventoryItem->getTalla0()->one()->termino ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Color&nbsp;</label>
                    <p><?= $listInventoryItem->getColor0()->one()->termino ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Tipo&nbsp;</label>
                    <p><?= $listInventoryItem->getTipo0()->one()->termino ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Detalle&nbsp;</label>
                    <p><?= $listInventoryItem->getDetalle0()->one()->termino ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Cantidad Esperada&nbsp;</label>
                    <p><?= $listInventoryItem->cantidad_esperada ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Cantidad Defectuasa&nbsp;</label>
                    <p><?= $listInventoryItem->cantidad_defectuasa ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Cantidad Entregada&nbsp;</label>
                    <p><?= $listInventoryItem->cantidad_entregada ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Precio Unidad&nbsp;</label>
                    <p>$<?= $listInventoryItem->precio_unidad ?></p>
                </div>
                <div class="col-lg-3">
                    <label>Precio Mayor&nbsp;</label>
                    <p>$<?= $listInventoryItem->precio_mayor ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
