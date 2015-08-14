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
    <link href="<?= Url::base()?>/css/admin/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= Url::base()?>/css/admin/multi-step.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= Url::base()?>/css/admin/simple-sidebar.css" rel="stylesheet" type="text/css" media="all" />
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="navbar-brand" href="#">Aliah </a>
                    </li>
                    <li>
                        <a class="navbar-brand" href="#menu-toggle" id="menu-toggle" >
                            <i class="glyphicon glyphicon-menu-hamburger"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <p class="navbar-text ">Hola <?= Yii::$app->user->identity->getNombre() ?></p>
                    </li>
                    <li>
                        <a href="<?=Yii::$app->urlManager->createUrl(['inventario/index'])?>"><i class="glyphicon glyphicon-th"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicon glyphicon-shopping-cart"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#"><i class="glyphicon glyphicon-user"></i> Mi Perfil</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?=Yii::$app->urlManager->createUrl(['usuario/logout'])?>"><i class="glyphicon glyphicon-remove"></i> Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="wrapper">
    <!-- Sidebar -->
    <?php if ( !Yii::$app->user->isGuest ): ?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="<?=Yii::$app->urlManager->createUrl(['punto-venta/index'])?>">punto de venta</a></li>
                <li><a href="<?=Yii::$app->urlManager->createUrl(['usuario/index'])?>">Usuarios</a></li>
                <li><a href="<?=Yii::$app->urlManager->createUrl(['gasto/index'])?>">Gastos</a></li>
                <li><a href="<?=Yii::$app->urlManager->createUrl(['ingreso/index'])?>">Ingresos</a></li>
            </ul>
        </div>
    <?php endif ?>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="main-content">
                            <div class="row text text-center">
                                <div id="alerts" class="col-lg-offset-3 col-lg-6">
                                    <?php foreach ( Yii::$app->session->getAllFlashes() as $key => $message ): ?>
                                        <div class="alert alert-<?= $key ?>" role="alert"><?= $message ?></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <?= $content ?>
                        </div>
                        <?php 
                            Modal::begin([
                                    'headerOptions' => ['id' => 'modalHeader'],
                                    'id' => 'modal',
                                    'size' => 'modal-lg',
                                    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                                    'closeButton' => [
                                      'label' => 'x',
                                      'class' => 'btn btn-danger btn-xs pull-right',
                                    ],
                                ]);
                                echo "<div id='modalContent'></div>";
                            Modal::end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php $this->endBody() ?>
<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>
</body>
</html>
<?php $this->endPage() ?>