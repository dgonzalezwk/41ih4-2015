<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "termino".
 *
 * @property integer $codigo
 * @property string $termino
 * @property integer $key
 * @property string $categoria
 * @property string $descripcion
 * @property boolean $estado
 *
 * @property Cliente[] $clientes
 * @property Factura[] $facturas
 * @property FacturaGanadora[] $facturaGanadoras
 * @property Gasto[] $gastos
 * @property Lote[] $lotes
 * @property Usuario[] $usuarios
 */
class Termino extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'termino';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['termino', 'key', 'categoria', 'descripcion'], 'required'],
            [['key'], 'integer'],
            [['estado'], 'boolean'],
            [['termino', 'categoria'], 'string', 'max' => 30],
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
            'termino' => 'Termino',
            'key' => 'Key',
            'categoria' => 'Categoria',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['sexo' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['metodo_pago' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaGanadoras()
    {
        return $this->hasMany(FacturaGanadora::className(), ['estado' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGastos()
    {
        return $this->hasMany(Gasto::className(), ['tipo_gasto' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLotes()
    {
        return $this->hasMany(Lote::className(), ['estado' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['estado' => 'codigo']);
    }
}
