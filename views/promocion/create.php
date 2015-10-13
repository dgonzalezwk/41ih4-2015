<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Promocion */

$this->title = 'Nueva Promocion';
$this->params['breadcrumbs'][] = ['label' => 'Promociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-create">

    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?= $this->render('_form', [ 'model' => $model, 'puntosVentaSeleccionados' => $puntosVentaSeleccionados]) ?>

</div>
