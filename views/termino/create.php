<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Termino */

$this->title = 'Create Termino';
$this->params['breadcrumbs'][] = ['label' => 'Terminos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="termino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
