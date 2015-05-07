<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                #'brandLabel' => 'My Company',
                #'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Permisos', 'url' => ['/accion-usuario']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Clientes', 'url' => ['/cliente']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Factura', 'url' => ['/factura']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Punto de venta', 'url' => ['/punto-venta']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Terminos', 'url' => ['/termino']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Usuarios', 'url' => ['/usuario']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Productos', 'url' => ['/producto']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Gastos', 'url' => ['/gasto']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Ingresos', 'url' => ['/ingreso']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Entradas|Salidas', 'url' => ['/lote']],
                    Yii::$app->user->isGuest ? ['label' => '']: ['label' => 'Horarios', 'url' => ['/horario']],
                    ['label' => 'Contactenos', 'url' => ['/contactenos']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Iniciar Sesión', 'url' => ['/site/login']] :
                        ['label' => 'Cerrar Sesión (' . Yii::$app->user->identity->nombre. " " . Yii::$app->user->identity->apellido . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
