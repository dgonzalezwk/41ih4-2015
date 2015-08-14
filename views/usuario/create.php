<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
        </div>
    </div>
    <div class="row">
    	<?= $this->render('_form', [ 'model' => $model , 'modulos'=> $modulos , 'puntosVentaSeleccionados' => $puntosVentaSeleccionados ] ) ?>
    </div>
</div>