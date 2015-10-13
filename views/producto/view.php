<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="producto-view ">
        <div class="row text text-center">
            <div class="col-lg-offset-1 col-lg-4 col-md-offset-1 col-md-4 col-sm-6 col-xs-12">
                <a href="#" class="thumbnail">
                  <?= Html::tag('img', '', [ "class" => "img-responsive" , 'src' => Url::base() . '/img/producto/'. $model->imagen ])  ?>
                </a>
            </div>
            <div class="col-lg-offset-1 col-lg-4 col-md-offset-1 col-md-4 col-sm-6 col-xs-12">
                <div class="row text text-center">
                    <h2><?= Html::encode($this->title) ?></h2>
                </div>
                <div class="row text text-justify">
                    <?= Html::tag('p', $model->descripcion , [] ) ?>
                </div>
                <h4> Existencias </h4>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text text-center">Categiria</th>
                                <th class="text text-center">Talla</th>
                                <th class="text text-center">Color</th>
                                <th class="text text-center">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $listInventoryItem): ?>
                                <?php if ( $listInventoryItem->getTipo0()->one()->termino != 'No identificado' && $listInventoryItem->getTalla0()->one()->termino != 'No identificado' && $listInventoryItem->getColor0()->one()->termino != 'No identificado' && $listInventoryItem->getDetalle0()->one()->termino != 'No identificado' ): ?>
                                <tr>
                                    <td><p><?= $listInventoryItem->getTipo0()->one()->termino ?></p></td>
                                    <td><p><?= $listInventoryItem->getTalla0()->one()->termino ?></p></td>
                                    <td><p><?= $listInventoryItem->getColor0()->one()->termino ?></p></td>
                                    <td><p><?= $listInventoryItem->getDetalle0()->one()->termino ?></p></td>
                                </tr>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="row text-center">
                    <p>
                        <?= Html::a('Editar Datos', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Eliminar Producto', ['delete', 'id' => $model->codigo], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>