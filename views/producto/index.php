<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="producto-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a('Create Producto', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->codigo), ['view', 'id' => $model->codigo]);
            },
        ]) ?>
    </div>
</div>