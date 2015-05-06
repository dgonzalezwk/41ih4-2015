<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "punto_venta".
 *
 * @property integer $codigo
 * @property string $telefono
 * @property string $extension
 * @property string $pais
 * @property string $ciudad
 * @property string $barrio
 * @property string $direccion
 * @property string $lugar
 * @property string $local
 * @property boolean $estado
 *
 * @property Factura[] $facturas
 * @property Gasto[] $gastos
 * @property Horario[] $horarios
 * @property Ingreso[] $ingresos
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
            [['telefono', 'pais', 'ciudad', 'barrio', 'direccion'], 'required'],
            [['estado'], 'boolean'],
            [['Whatsapp'], 'integer'],
            [['telefono'], 'string', 'max' => 21],
            [['extension'], 'string', 'max' => 20],
            [['pais'], 'string', 'max' => 15],
            [['ciudad'], 'string', 'max' => 15],
            [['barrio', 'direccion','lugar'], 'string', 'max' => 25],
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
            'Whatsapp' => 'Whatsapp',
            'telefono' => 'Telefono',
            'extension' => 'Extension',
            'pais' => 'Pais',
            'ciudad' => 'Ciudad',
            'barrio' => 'Barrio',
            'direccion' => 'Direccion',
            'local' => 'Local',
            'estado' => 'Estado',
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
        return $this->hasMany(Gasto::className(), ['punto_venta' => 'codigo']);
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
        return $this->hasMany(Ingreso::className(), ['destino' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLotes()
    {
        return $this->hasMany(Lote::className(), ['destino' => 'codigo']);
    }
}
