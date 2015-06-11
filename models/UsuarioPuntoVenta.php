<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_punto_venta".
 *
 * @property integer $codigo
 * @property integer $usuario
 * @property integer $punto_venta
 * @property integer $estado
 *
 * @property PuntoVenta $puntoVenta
 * @property Usuario $usuario0
 */
class UsuarioPuntoVenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_punto_venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'punto_venta', 'estado'], 'required'],
            [['usuario', 'punto_venta', 'estado'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'usuario' => 'Usuario',
            'punto_venta' => 'Punto Venta',
            'estado' => 'Estado',
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
    public function getUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario']);
    }
}
