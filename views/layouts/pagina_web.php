<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

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
    <link href="<?= Url::base()?>/css/web/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= Url::base()?>/css/web/stylemovile.css" rel="stylesheet" type="text/css" media="all" />
    <script type="application/x-javascript"> 
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="header_bg" id="home">
        <div class="container">
            <div class="row header text-center">
                <div class="h_logo">
                    <a href="?controlador=usuario"><img src="<?= Url::base()?>/img/logo.png" alt="" class="responsive h_logo"/></a>
                </div>
                <nav class="top-nav">
                    <ul class="top-nav nav_list">
                        <li><a href="?controlador=Index">Inicio</a></li>
                        <li><a href="?controlador=Nosotros">Nosotros</a></li>
                        <li class="logo"><a title="inicio" href="?controlador=Index"><img src="<?= Url::base()?>/img/logo.png" alt="" class="responsive logo"/></a></li>
                        <li><a href="?controlador=Productos">Productos</a></li>
                        <li><a href="?controlador=Contactenos">Contactenos</a></li>
                    </ul>
                    <a href="vista/#" id="pull"><img src="<?= Url::base()?>/img/nav-icon.png" title="menu" /></a>
                </nav>
            </div>
        </div>
        </div>
       
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
       
        <div class="footer1_bg">
            <img id="img_foother" src="<?= Url::base()?>/img/img_foother2.png">
            <p id="p_foother">Vestidos Para La Mujer Elegante.</p>
        </div>
        <div class="social">
            <ul>
                <li><a href="http://www.facebook.com/" target="_blank" class="icon-facebook"></a></li>
                <li><a href="http://www.twitter.com/" target="_blank" class="icon-twitter"></a></li>
                <li><a href="http://www.googleplus.com/" target="_blank" class="icon-googleplus"></a></li>
            </ul>
        </div>
    <script type="text/javascript" src="<?= Url::base()?>/js/main.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
