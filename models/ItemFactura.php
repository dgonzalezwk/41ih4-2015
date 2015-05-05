<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_factura".
 *
 * @property integer $codigo
 * @property integer $factura
 * @property integer $producto
 * @property integer $cantidad
 *
 * @property Factura $factura0
 * @property Producto $producto0
 */
class ItemFactura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_factura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['factura', 'producto', 'cantidad'], 'required'],
            [['factura', 'producto', 'cantidad'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'factura' => 'Factura',
            'producto' => 'Producto',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura0()
    {
        return $this->hasOne(Factura::className(), ['codigo' => 'factura']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto0()
    {
        return $this->hasOne(Producto::className(), ['codigo' => 'producto']);
    }
}
