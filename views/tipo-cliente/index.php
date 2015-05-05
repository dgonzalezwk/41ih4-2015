<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'tipo',
            'cantidad_compras',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
