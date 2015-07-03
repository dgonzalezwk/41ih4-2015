<?php
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php if ( !Yii::$app->user->isGuest ): ?>
    <div class="col-lg-2">
        <div class="btn-group-vertical" role="group">
            <img src="<?= Url::base() ?>/img/logo.png" alt="..." class="img-thumbnail">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    puntos de venta
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <?php foreach ( Yii::$app->user->identity->usuarioPuntoVentas as $key => $usuarioPuntoVenta): ?>
                        <?php if ( Yii::$app->request->cookies->getValue('puntoVentaSelected', null) != null && Yii::$app->request->cookies->getValue('puntoVentaSelected', null) == $key ): ?>
                            <li><a class="btn-primary active" href="<?= Url::toRoute( [ 'usuario/cambiar-punto-venta','index' => $key ] ) ?>"><?= $usuarioPuntoVenta->puntoVenta->ciudad." - ".$usuarioPuntoVenta->puntoVenta->barrio." - ".$usuarioPuntoVenta->puntoVenta->direccion ?></a></li>
                        <?php else: ?>
                            <li><a href="<?= Url::toRoute( [ 'usuario/cambiar-punto-venta','index' => $key ] ) ?>"><?= $usuarioPuntoVenta->puntoVenta->ciudad." - ".$usuarioPuntoVenta->puntoVenta->barrio." - ".$usuarioPuntoVenta->puntoVenta->direccion ?></a></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
            <a href="<?=Yii::$app->urlManager->createUrl(['gasto/index'])?>" class="btn btn-default">Gastos</a>
            <a href="<?=Yii::$app->urlManager->createUrl(['usuario/index'])?>" class="btn btn-default">Usuarios</a>
            <a href="<?=Yii::$app->urlManager->createUrl(['ingreso/index'])?>" class="btn btn-default">Ingresos</a>
        </div>
    </div>
<?php endif ?>
<div class="container-fluid">
    <div class="col-lg-10">
        <div class="row">
            <nav class="navbar navbar-default">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
        
        <div class="row">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
        
        <div class="container-fluid">
            <div class="row text text-center">
                <div class="col-lg-6">
                    <?php foreach ( Yii::$app->session->getAllFlashes() as $key => $message ): ?>
                        <div class="alert alert-<?= $key ?>" role="alert"><?= $message ?></div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <?= $content ?>
            </div>
        </div>
    
    </div>
</div>
<?php
    Modal::begin([
    ]);
    Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>