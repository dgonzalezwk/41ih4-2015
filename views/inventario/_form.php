<?php


use app\assets\AppDate;
use app\models\PuntoVentaSearch;
use app\models\ItemInventario;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
?>
<fieldset>
    <!--<label class="fs-title">Create your account</label>
    <label class="fs-subtitle">This is step 1</label>/-->
    <?php $form = ActiveForm::begin([
        'id' => 'inventario-form',
        'action' => Url::to(['add-item']),
    ]); ?>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                    'language' => 'es',
                    'value' => AppDate::date(),
                    'removeButton' => false,
                    'options' => ['placeholder' => ''],
                    'pluginEvents' => [
                        "show" => "function(e) {  }","hide" => "function(e) {  }","clearDate" => "function(e) {  }","changeDate" => "function(e) {  }","changeYear" => "function(e) {  }","changeMonth" => "function(e) {  }",
                    ],
                    'pluginOptions' => [
                        'orientation' => 'top left',
                        'autoclose' => true,
                        'format' => 'dd MM yyyy',
                        'startDate'=> '-7d',
                        'endDate' => '0d',
                        'todayBtn' => true
                    ]
                ]) ?>
                <?= $form->field($model, 'origen')->dropDownList(
                    ArrayHelper::map( 
                        PuntoVentaSearch::all() , 
                        'codigo', 
                        function($model, $defaultValue) {
                            return $model->ciudad.'-'.$model->barrio.'-'.$model->direccion;
                        }
                    ),[ 'prompt' => 'Seleccione Una Opcion' ]) 
                ?>
                <?= $form->field($model, 'punto_venta')->dropDownList(
                    ArrayHelper::map( 
                        PuntoVentaSearch::all() , 
                        'codigo', 
                        function($model, $defaultValue) {
                            return $model->ciudad.'-'.$model->barrio.'-'.$model->direccion;
                        }
                    ),[ 'prompt' => 'Seleccione Una Opcion' ]) 
                ?>
                <?= $form->field($model, 'codigoBarras')->textInput([ 'data-url' => Yii::$app->urlManager->createUrl(['producto/view-all']) ])?>
            </div>
            <div class="col-lg-8">
                <div class="panel-group" id="informacion-producto" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a role="button" data-toggle="collapse" data-parent="#informacion-producto" href="#collapse-producto-item" aria-expanded="true" aria-controls="collapseOne">
                                <i class="glyphicon glyphicon-picture"></i> Informacion de producto
                            </a>
                        </div>
                        <div id="collapse-producto-item" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img id="img-producto" class="img-rounded" src="" alt="">
                                    </div>
                                    <div class="col-lg-8 text text-left">
                                        <div class="row">
                                            <p><label>Codigo:&nbsp;</label><span id="codigo-producto">xxx</span></p>
                                            <p><label>Nombre:&nbsp;</label><span id="nombre-producto">aaaaaaaaaaaaaaaaaaa</span></p>
                                            <p><label>Estado:&nbsp;</label><span id="estado-producto">aaaaaaaaaaa</span></p>
                                        </div>
                                        <div class="row text text-left">
                                            <p><label>Descripcion:</label><span id="descripcion-producto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation </span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    <div class="row">
        <?= $this->render( '//item-inventario/_form' , [ 'model' => new ItemInventario() ] ); ?>
    </div>
    <br />
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['add-item'], ['class' => 'btn btn-primary add-item', 'onclick' => "addItem( '#inventario-form' , $(this) , event )" ]) ?>
    <button type="button" class="next btn btn-success">Siguiente <i class="glyphicon glyphicon-chevron-right"></i> </button>
</fieldset>
<fieldset id="lista">
    <?php $listInventory = Yii::$app->session->get( 'listInventory' , [] ); ?>
    <?php foreach ($listInventory as $key => $listInventoryItem): ?>
        <div class="row item-list" id="<?= $key ?>" >
            <div class="col-lg-3">
                <img src="<?= $listInventoryItem->getProducto0()->one()->getImageUrl() ?>" class="img-rounded img-responsive" >
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row title-item-list">
                            <div class="col-lg-6 text text-left">
                                <h3><?= $listInventoryItem->getProducto0()->one()->nombre ?></h3>
                            </div>
                            <div class="col-lg-6 text text-right">
                                <p>
                                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', [''], ['class' => 'btn btn-warning', 'onclick' => "" ]) ?>
                                    <?= Html::a('<i class="glyphicon glyphicon-remove"></i>', ['remove-item'], ['class' => 'btn btn-danger' , 'data-id' => $key , 'onclick' => "removeItem( $(this) , event )" ]) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label>Codigo&nbsp;</label>
                        <p><?= $listInventoryItem->producto ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Talla&nbsp;</label>
                        <p><?= $listInventoryItem->getTalla0()->one()->termino ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Color&nbsp;</label>
                        <p><?= $listInventoryItem->getColor0()->one()->termino ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Tipo&nbsp;</label>
                        <p><?= $listInventoryItem->getTipo0()->one()->termino ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Detalle&nbsp;</label>
                        <p><?= $listInventoryItem->getDetalle0()->one()->termino ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Cantidad Esperada&nbsp;</label>
                        <p><?= $listInventoryItem->cantidad_esperada ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Cantidad Defectuasa&nbsp;</label>
                        <p><?= $listInventoryItem->cantidad_defectuasa ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Cantidad Entregada&nbsp;</label>
                        <p><?= $listInventoryItem->cantidad_entregada ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Precio Unidad&nbsp;</label>
                        <p><?= $listInventoryItem->precio_unidad ?></p>
                    </div>
                    <div class="col-lg-3">
                        <label>Precio Mayor&nbsp;</label>
                        <p><?= $listInventoryItem->precio_mayor ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <button type="button" class="previous btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</button>
    <button type="button" class="next btn btn-success">Siguiente <i class="glyphicon glyphicon-chevron-right"></i> </button>
</fieldset>
<fieldset class="cosolidado">
    <button type="button" class="previous btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</button>
    <button type="submit" class="submit btn btn-success"><i class="glyphicon glyphicon-saved"></i> Submit</button>
</fieldset>
<?= $this->registerJsFile('@web/js/jsInventarios.js', ['depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>