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
    <link href="<?= Url::base()?>/css/admin/simple-sidebar.css" rel="stylesheet" type="text/css" media="all" />
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#menu-toggle" id="menu-toggle" >
                    <i class="glyphicon glyphicon-menu-hamburger"></i>
                </a>
                <a class="navbar-brand" href="#">Aliah </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li role="separator" class="divider"></li>
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
                <li><a href="#">Dashboard</a></li>
            </ul>
        </div>
    <?php endif ?>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>
                        </div>
                        <div class="row text text-center">
                            <div id="alerts" class="col-lg-offset-3 col-lg-6">
                                <?php foreach ( Yii::$app->session->getAllFlashes() as $key => $message ): ?>
                                    <div class="alert alert-<?= $key ?>" role="alert"><?= $message ?></div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="row" id="main-content">
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