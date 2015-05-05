<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "punto_venta".
 *
 * @property integer $codigo
 * @property string $telefono
 * @property string $extension
 * @property string $ciudad
 * @property string $barrio
 * @property string $direccion
 * @property string $local
 *
 * @property Factura[] $facturas
 * @property Gastos[] $gastos
 * @property Horario[] $horarios
 * @property Ingresos[] $ingresos
 * @property Lote[] $lotes
 */
class PuntoVenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'punto_venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telefono', 'extension', 'ciudad', 'barrio', 'direccion', 'local'], 'required'],
            [['telefono'], 'string', 'max' => 21],
            [['extension'], 'string', 'max' => 20],
            [['ciudad'], 'string', 'max' => 15],
            [['barrio', 'direccion'], 'string', 'max' => 25],
            [['local'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'telefono' => 'Telefono',
            'extension' => 'Extension',
            'ciudad' => 'Ciudad',
            'barrio' => 'Barrio',
            'direccion' => 'Direccion',
            'local' => 'Local',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['punto_venta' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGastos()
    {
        return $this->hasMany(Gastos::className(), ['punto_venta' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios()
    {
        return $this->hasMany(Horario::className(), ['punto_venta' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresos()
    {
        return $this->hasMany(Ingresos::className(), ['destino' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLotes()
    {
        return $this->hasMany(Lote::className(), ['destino' => 'codigo']);
    }
}
