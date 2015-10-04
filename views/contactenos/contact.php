<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Contactenos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>
        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>
    <?php else: ?>
    <div class="row title-window">
        <div class="col-md-12 text text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-5 contact_left">
            <h3>¿Deseas entrar en contacto con nosotros?</h3>
            <p>Llena el siguiente formulario.</p>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Enviar datos', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-5">
            <div class="col-md-12">
                <h3>Visitanos en nuestras tiendas</h3>
                <br/>
                <br/>
                <br/>
            </div>
            <?= ListView::widget([
                'dataProvider' => $dataProviderPuntosVenta,
                'itemOptions' => ['class' => 'item'],
                'summary' => Html::tag('div', '' , [ "class" => "text text-center" ]),
                'itemView' => function ($model, $key, $index, $widget) {
                    return #
                        Html::tag('div',
                            Html::tag('div',
                                Html::tag('div',
                                    Html::tag('span', $model->pais .' - ' . $model->ciudad , ['class' => 'pull-right text-muted small']) .
                                    Html::tag('h3', $model->direccion . ' - ' . $model->barrio , [] ) .
                                    Html::tag('p', 'Lugar: '.$model->lugar , [] ) .
                                    Html::tag('p', 'Local: '.$model->local , [] ) .
                                    Html::tag('p', 'Telefono: '.$model->telefono. ' - ext. ' .$model->extension , [] )
                                , [ "class" => "caption" ])
                            , [ "class" => "thumbnail" ])
                        , [ "class" => "col-lg-12 text text-center" ]);
                    #;
                },
            ]) ?>
        </div>
    </div>
    <?php endif; ?>
</div>
