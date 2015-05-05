<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Termino */

$this->title = 'Update Termino: ' . ' ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Terminos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="termino-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
