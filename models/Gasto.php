<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gasto".
 *
 * @property integer $codigo
 * @property string $fecha
 * @property string $monto
 * @property integer $usuario
 * @property integer $usuario_autorizador
 * @property string $descripcion
 * @property integer $tipo_gasto
 * @property integer $punto_venta
 * @property integer $usuario_registro
 * @property string $fecha_registro
 * @property integer $usuario_actualizacion
 * @property string $fecha_actualizacion
 *
 * @property Usuario $usuario0
 * @property Usuario $usuarioAutorizador
 * @property Termino $tipoGasto
 * @property PuntoVenta $puntoVenta
 * @property Usuario $usuarioRegistro
 * @property Usuario $usuarioActualizacion
 */
class Gasto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gasto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'monto', 'usuario', 'usuario_autorizador', 'descripcion', 'tipo_gasto', 'punto_venta', 'usuario_registro', 'fecha_registro', 'usuario_actualizacion', 'fecha_actualizacion'], 'required'],
            [['fecha', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['usuario', 'usuario_autorizador', 'tipo_gasto', 'punto_venta', 'usuario_registro', 'usuario_actualizacion'], 'integer'],
            [['monto'], 'string', 'max' => 12],
            [['descripcion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'fecha' => 'Fecha',
            'monto' => 'Monto',
            'usuario' => 'Usuario',
            'usuario_autorizador' => 'Usuario Autorizador',
            'descripcion' => 'Descripcion',
            'tipo_gasto' => 'Tipo Gasto',
            'punto_venta' => 'Punto Venta',
            'usuario_registro' => 'Usuario Registro',
            'fecha_registro' => 'Fecha Registro',
            'usuario_actualizacion' => 'Usuario Actualizacion',
            'fecha_actualizacion' => 'Fecha Actualizacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioAutorizador()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_autorizador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoGasto()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'tipo_gasto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntoVenta()
    {
        return $this->hasOne(PuntoVenta::className(), ['codigo' => 'punto_venta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioRegistro()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_registro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioActualizacion()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_actualizacion']);
    }
}
