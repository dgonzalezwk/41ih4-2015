<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

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
	<div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ( Yii::$app->session->getAllFlashes() as $key => $message ): ?>
                <div class="alert alert-<?= $key ?>" role="alert"><?= $message ?></div>
            <?php endforeach ?>
        </div>
    </div>
	<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>