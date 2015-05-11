<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "factura".
 *
 * @property integer $codigo
 * @property integer $usuario
 * @property integer $cliente
 * @property integer $punto_venta
 * @property string $fecha
 * @property integer $metodo_pago
 *
 * @property Termino $metodoPago
 * @property PuntoVenta $puntoVenta
 * @property Usuario $usuario0
 * @property Cliente $cliente0
 * @property FacturaGanadora[] $facturaGanadoras
 * @property ItemFactura[] $itemFacturas
 */
class Factura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'cliente', 'punto_venta', 'fecha', 'metodo_pago'], 'required'],
            [['usuario', 'cliente', 'punto_venta', 'metodo_pago'], 'integer'],
            [['fecha'], 'safe']
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
            'cliente' => 'Cliente',
            'punto_venta' => 'Punto Venta',
            'fecha' => 'Fecha',
            'metodo_pago' => 'Metodo Pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoPago()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'metodo_pago']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente0()
    {
        return $this->hasOne(Cliente::className(), ['codigo' => 'cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaGanadoras()
    {
        return $this->hasMany(FacturaGanadora::className(), ['factura' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemFacturas()
    {
        return $this->hasMany(ItemFactura::className(), ['factura' => 'codigo']);
    }
}
