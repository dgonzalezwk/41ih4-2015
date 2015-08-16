<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemInventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Inventarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Inventario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->codigo), ['view', 'id' => $model->codigo]);
        },
    ]) ?>

</div>
