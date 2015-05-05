<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccionUsuario */

$this->title = 'Create Accion Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Accion Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
