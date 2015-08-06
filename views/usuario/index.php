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
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="glyphicon glyphicon-search"></i>&nbsp;Filtrar por...
            </a>
            <?= Html::button('<i class="glyphicon glyphicon-plus"></i> Nuevo Usuario', [ 'value' => Url::to( [ 'usuario/create' ]) ,  'class' => 'btn btn-success' , 'id' => 'modalButton' ]) ?>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="well">
            <div class="row">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>
</div>
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
</div>