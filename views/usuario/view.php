<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nombre." ".$model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="usuario-view">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'codigo',
                'identificacion',
                'nombre',
                'apellido',
                'telefono',
                'email:email',
                'fecha_nacimiento',
                'sexo.termino',
                'usuario',
                //'contrasena',
                'rol.nombre',
                'estado.termino',
            ],
        ]) ?>
        <p>
            <?= Html::a('Editar datos', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar Usuario', ['delete', 'id' => $model->codigo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>