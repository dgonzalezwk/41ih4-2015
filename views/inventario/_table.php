<?php
	use yii\helpers\Html;
?>

<?php $TotalCantidadEsperada = 0; ?>
<?php $TotalCantidadDefectuasa = 0; ?>
<?php $TotalCantidadEntregada = 0; ?>
<?php $TotalPrecioUnidad = 0; ?>
<?php $TotalPrecioMayor = 0; ?>

<?php if ( count( $listInventory ) == 0 ): ?>
<div class="col-lg-12 text text-center">
        <p>El inventario no tiene productos actualmente.</p>
    </div>
<?php endif ?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th class="text text-center">Cod. Bar.</th>
			<th class="text text-center">Producto</th>
			<!--<th class="text text-center">Talla</th>
			<th class="text text-center">Color</th>
			<th class="text text-center">Tipo</th>
			<th class="text text-center">Detalle</th>-->
			<th class="text text-center">Cant Esp.</th>
			<th class="text text-center">Cant Def.</th>
			<th class="text text-center">Cant Ent.</th>
			<th class="text text-center">Val. Unidad</th>
			<th class="text text-center">Val. Mayor</th>
			<th class="text text-center">Sub Total Val. Unidad</th>
			<th class="text text-center">Sub Total Val. Mayor</th>
			<th class="text text-center"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($listInventory as $listInventoryItem): ?>
			<tr class="<?= $listInventoryItem->codigo?>">
				<td><?= $listInventoryItem->codigo_barras ?></td>
				<td><?= $listInventoryItem->getProducto0()->one()->nombre ?></td>
				<!--<td><?= $listInventoryItem->getTalla0()->one()->termino ?></td>
				<td><?= $listInventoryItem->getColor0()->one()->termino ?></td>
				<td><?= $listInventoryItem->getTipo0()->one()->termino ?></td>
				<td><?= $listInventoryItem->getDetalle0()->one()->termino ?></td>-->

				<td><?= $listInventoryItem->cantidad_esperada ?></td>
					<?php $TotalCantidadEsperada += $listInventoryItem->cantidad_esperada; ?>
				<td><?= $listInventoryItem->cantidad_defectuasa ?></td>
					<?php $TotalCantidadDefectuasa += $listInventoryItem->cantidad_defectuasa; ?>
				<td><?= $listInventoryItem->cantidad_entregada ?></td>
					<?php $TotalCantidadEntregada += $listInventoryItem->cantidad_entregada; ?>
				<td>$<?= $listInventoryItem->precio_unidad ?></td>
				<td>$<?= $listInventoryItem->precio_mayor ?></td>
				<td>$<?= $listInventoryItem->precio_unidad * ( $listInventoryItem->cantidad_entregada - $listInventoryItem->cantidad_defectuasa ) ?></td>
					<?php $TotalPrecioUnidad += $listInventoryItem->precio_unidad * ( $listInventoryItem->cantidad_entregada - $listInventoryItem->cantidad_defectuasa ); ?>
				<td>$<?= $listInventoryItem->precio_mayor * ( $listInventoryItem->cantidad_entregada - $listInventoryItem->cantidad_defectuasa )?></td>
					<?php $TotalPrecioMayor += $listInventoryItem->precio_mayor * ( $listInventoryItem->cantidad_entregada - $listInventoryItem->cantidad_defectuasa ); ?>
				<td>
					<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['item-inventario/view' , 'id' => $listInventoryItem->codigo ], [ 'onclick' => "selectedItemTable( $(this) , event );" ]) ?>
	                <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['item-inventario/delete', 'id' => $listInventoryItem->codigo], [ 'onclick' => "removeItem( $(this) , event );" ]) ?>
				</td>
			</tr>
		<?php endforeach ?>
		<tr>
			<td>Total</td>
			<td></td>
			<td><?= $TotalCantidadEsperada ?></td>
			<td><?= $TotalCantidadDefectuasa ?></td>
			<td><?= $TotalCantidadEntregada ?></td>
			<td></td>
			<td></td>
			<td>$<?= $TotalPrecioUnidad ?></td>
			<td>$<?= $TotalPrecioMayor ?></td>
			<td></td>
		</tr>
	</tbody>
</table>