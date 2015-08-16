<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventario".
 *
 * @property integer $codigo
 * @property string $fecha
 * @property integer $punto_venta
 * @property integer $origen
 * @property integer $estado
 * @property integer $usuario_registro
 * @property string $fecha_registro
 * @property integer $usuario_actualizador
 * @property string $fecha_actualizacion
 *
 * @property PuntoVenta $puntoVenta
 * @property PuntoVenta $origen0
 * @property Termino $estado0
 * @property Usuario $usuarioRegistro
 * @property Usuario $usuarioActualizador
 */
class Inventario extends \yii\db\ActiveRecord
{
    public $codigoBarras;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'punto_venta', 'origen', 'estado', 'usuario_registro', 'fecha_registro', 'usuario_actualizador', 'fecha_actualizacion'], 'required'],
            [['fecha', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['punto_venta', 'origen', 'estado', 'usuario_registro', 'usuario_actualizador'], 'integer']
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
            'punto_venta' => 'Punto Venta',
            'origen' => 'Origen',
            'estado' => 'Estado',
            'usuario_registro' => 'Usuario Registro',
            'fecha_registro' => 'Fecha Registro',
            'usuario_actualizador' => 'Usuario Actualizador',
            'fecha_actualizacion' => 'Fecha Actualizacion',
            'codigoBarras' => 'Codigo de barras',
        ];
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
    public function getOrigen0()
    {
        return $this->hasOne(PuntoVenta::className(), ['codigo' => 'origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'estado']);
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
    public function getUsuarioActualizador()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_actualizador']);
    }
}
