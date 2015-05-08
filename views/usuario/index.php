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
                    'identificacion',
                    ['attribute' => 'nombre','value' => 'nombre'],
                    ['attribute' => 'sexo','value' => 'sexo0.termino'],
                    'usuario',
                    ['attribute' => 'rol','value' => 'rol0.nombre'],
                    ['attribute' => 'estado','value' => 'estado0.termino'],
                    // 'email:email',
                    // 'fecha_nacimiento',
                    // 'contrasena',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>