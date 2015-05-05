<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ingreso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'fecha_cierre_caja',
            'fecha_llegada',
            'cantidad',
            'corresponde:boolean',
            // 'usuario_pago',
            // 'usuario_autorizador',
            // 'igualado:boolean',
            // 'suma_anexada',
            // 'descripcion',
            // 'punto_venta',
            // 'origen',
            // 'destino',
            // 'usuario_registro',
            // 'fecha_registro',
            // 'usuario_actualizacion',
            // 'fecha_actualizacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
