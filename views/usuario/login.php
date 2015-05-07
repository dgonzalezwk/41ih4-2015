<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Inicio De Sesión Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="usuario-login">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Por favor, rellene los siguientes campos para iniciar sesión:</p>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal '],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>
        <?= $form->field($model, 'username')->label('Nombre De Usuario') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>
        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->checkbox()->label('Recordarme') ?>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('iniciar sesión', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <div class="col-lg-offset-1" style="color:#999;">
            <!-- You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
            To modify the username/password, please check out the code <code>app\models\User::$users</code>.-->
        </div>
    </div>
</div>