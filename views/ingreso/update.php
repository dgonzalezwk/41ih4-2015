<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = 'Editar Ingreso: ' . $model->fecha_cierre_caja . ' - No ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fecha_cierre_caja . ' - No ' . $model->codigo , 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="ingreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
