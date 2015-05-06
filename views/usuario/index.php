<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="usuario-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php Pjax::begin(['timeout' => 10000,]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'codigo',
                    'identificacion',
                    'nombre',
                    'apellido',
                    'telefono',
                    // 'email:email',
                    // 'fecha_nacimiento',
                    // 'sexo',
                    // 'usuario',
                    // 'contrasena',
                    // 'rol',
                    // 'estado',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>