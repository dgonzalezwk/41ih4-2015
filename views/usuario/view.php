<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nombre." ".$model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">
    <div class="row title-window">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 text text-right vcenter">
            <?= Html::button('<i class="glyphicon glyphicon-pencil"></i> Editar datos', [ 'value' => Url::to( [ 'usuario/update' , 'id'=> $model->codigo ]) ,  'class' => 'btn btn-primary modalButton']) ?>
            <?php /*echo Html::a('Eliminar Usuario', ['delete', 'id' => $model->codigo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);*/ ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="glyphicon glyphicon-th-list"></i> Datos del usuario</div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <p><label>Nombre:</label>&nbsp;<?= $model->nombre . " " .$model->apellido ?></p>
                        <p><label>Identificacion:</label>&nbsp;<?= $model->identificacion ?></p>
                        <p><label>Fecha Nacimiento:</label>&nbsp;</p>
                        <p><label>Sexo:</label>&nbsp;<?= $model->sexo0->termino ?></p>
                        <p><label>Email:</label>&nbsp;<?= $model->email ?></p>
                    </div>
                    <div class="col-lg-6">
                        <p><label>Telefono:</label>&nbsp;<?= $model->telefono ?></p>
                        <p><label>Usuario:</label>&nbsp;<?= $model->usuario ?></p>
                        <p><label>Rol:</label>&nbsp;<?= $model->rol0->nombre ?></p>
                        <p><label>Estado:</label>&nbsp;<?= $model->estado0->termino ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="panel-group" id="puntosVenta" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a role="button" data-toggle="collapse" data-parent="#puntosVenta" href="#collapsePuntosVenta" aria-expanded="true" aria-controls="collapseOne">
                            <i class="glyphicon glyphicon-home"></i> Puntos de venta asignados
                        </a>
                    </div>
                    <div id="collapsePuntosVenta" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?php foreach ($model->usuarioPuntoVentas as $puntoVenta ): ?>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <p><?= $puntoVenta->puntoVenta->ciudad." ".$puntoVenta->puntoVenta->barrio." ".$puntoVenta->puntoVenta->direccion ?></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ( $puntoVenta->estado ): ?>
                                            <span class="label label-success">Asignado</span>
                                        <?php else: ?>
                                            <span class="label label-danger">No asignado</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="panel-group" id="permisos" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a role="button" data-toggle="collapse" data-parent="#permisos" href="#collapsePermisos" aria-expanded="true" aria-controls="collapseOne">
                            <i class="glyphicon glyphicon-ok"></i> Permisos
                        </a>
                    </div>
                    <div id="collapsePermisos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?php foreach ($model->accionUsuarios as $permiso ): ?>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <p><?= $permiso->accion0->accion ?></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ( $permiso->estado ): ?>
                                            <span class="label label-success">Asignado</span>
                                        <?php else: ?>
                                            <span class="label label-danger">No asignado</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>