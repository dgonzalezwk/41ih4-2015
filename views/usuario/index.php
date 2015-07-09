<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\TerminoSearch;
use app\models\RolSearch;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(['timeout' => 10000,]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            #'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'identificacion',
                ['attribute' => 'nombre','value' => 'nombre'],
                'usuario',
                ['attribute' => 'sexo','value' => 'sexo0.termino','format'=>'raw','filter' => ArrayHelper::map(TerminoSearch::searchSexos(), 'codigo', 'termino'),],
                ['attribute' => 'rol','value' => 'rol0.nombre','format'=>'raw','filter' => ArrayHelper::map(RolSearch::searchAll(), 'codigo', 'nombre'),],
                ['attribute' => 'estado','value' => 'estado0.termino','format'=>'raw','filter' =>ArrayHelper::map(TerminoSearch::searchEstadosUsuario(), 'codigo', 'termino'),],
                // 'email:email',
                // 'fecha_nacimiento',
                // 'contrasena',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    <p>
        <?= Html::button('Crear Usuario', [ 'value' => Url::to( [ 'usuario/create' ]) ,  'class' => 'btn btn-success' , 'id' => 'modalButton' ]) ?>
    </p>
</div>