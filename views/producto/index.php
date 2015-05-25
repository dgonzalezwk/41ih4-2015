<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="producto-index">
        <?php Pjax::begin(['timeout' => 10000,]); ?>
        <div class="row">
            <h1><?= Html::encode($this->title) ?> | <?= Html::a('Create Producto', ['create'], ['class' => 'btn btn-success']) ?> </h1> 
        </div>
        <div class="row">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model->codigo), ['view', 'id' => $model->codigo]);
                },
            ]) ?>
        </div>
        <?php Pjax::end(); ?>
    </div>
</div>