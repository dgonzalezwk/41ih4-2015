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
            <div class="col-lg-6">
                <?= Html::tag('img', '', [ "class" => "img-responsive" , 'src' => Url::base() . '/img/producto/'. $model->imagen ])  ?>
            </div>
            <div class="col-lg-6">
                <div class="row text text-justify">
                    <h2><?= Html::encode($this->title) ?></h2>
                    <?= Html::tag('p', $model->descripcion , [] ) ?>
                    <?= Html::tag('p', $model->estado0->termino , [] ) ?>
                    <?= Html::tag('p', $model->categoria0->termino , [] ) ?>
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