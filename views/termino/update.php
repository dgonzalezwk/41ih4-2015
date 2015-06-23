<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Termino */

$this->title = 'Editar Termino: ' . ' ' . $model->termino;
$this->params['breadcrumbs'][] = ['label' => 'Terminos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->termino, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="termino-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>