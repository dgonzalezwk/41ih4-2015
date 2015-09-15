<?php

use yii\helpers\Html;

?>

<?php foreach ($listInventory as $key => $listInventoryItem): ?>
    <div class="row item-list <?= $key ?>">
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
                                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['selected-item'], ['class' => 'btn btn-warning', 'data-id' => $key ,'onclick' => "selectedItemList( $(this) , event );" ]) ?>
                                <?= Html::a('<i class="glyphicon glyphicon-remove"></i>', ['remove-item'], ['class' => 'btn btn-danger' , 'data-id' => $key , 'onclick' => "removeItem( $(this) , event )" ]) ?>
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