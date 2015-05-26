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
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="row text text-center">
            <div class="col-lg-6">
                <?= Html::tag('img', '', [ "class" => "img-responsive" , 'src' => Url::base() . '/img/producto/'. $model->imagen ])  ?>
            </div>
            <div class="col-lg-6">
                <div class="row">
                </div>
                <div class="row text text-center">
                    <?= Html::tag('h3', $model->nombre , [] ) ?>
                    <?= Html::tag('p', $model->descripcion , [] ) ?>
                    <?= Html::tag('span', $model->estado0->termino , ['class' => 'pull-right text-muted small']) ?>
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