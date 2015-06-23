<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GastoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gastos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gasto-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fecha',
            'monto',
            'tipo_gasto',
            'punto_venta',
            'usuario_registro',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Registrar Gasto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>    
</div>
