<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionUsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Accion Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'accion',
            'usuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
