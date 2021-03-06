<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_inventario".
 *
 * @property integer $codigo
 * @property integer $inventario
 * @property integer $producto
 * @property integer $color
 * @property integer $talla
 * @property integer $tipo
 * @property integer $detalle
 * @property integer $cantidad_esperada
 * @property integer $cantidad_defectuasa
 * @property integer $cantidad_entregada
 * @property integer $cantidad_actual
 * @property string $precio_unidad
 * @property string $precio_mayor
 * @property integer $estado
 * @property string $codigo_barras
 *
 * @property ItemFactura[] $itemFacturas
 * @property Producto $producto0
 * @property Termino $color0
 * @property Termino $talla0
 * @property Termino $estado0
 * @property Termino $tipo0
 * @property Termino $detalle0
 * @property Inventario $inventario0
 */
class ItemInventario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'producto', 'color', 'talla', 'tipo', 'detalle', 'cantidad_esperada', 'cantidad_defectuasa', 'cantidad_entregada', 'cantidad_actual', 'precio_unidad', 'precio_mayor', 'estado', 'codigo_barras'], 'required'],
            [['inventario', 'producto', 'color', 'talla', 'tipo', 'detalle', 'cantidad_esperada', 'cantidad_defectuasa', 'cantidad_entregada', 'cantidad_actual', 'estado'], 'integer'],
            [['producto', 'cantidad_esperada', 'cantidad_entregada'], 'integer' , 'min' => 1 ],
            [['precio_unidad', 'precio_mayor'], 'number', 'min' => 1],
            [['codigo_barras'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'inventario' => 'Inventario',
            'producto' => 'Producto',
            'color' => 'Color',
            'talla' => 'Talla',
            'tipo' => 'Tipo',
            'detalle' => 'Detalle',
            'cantidad_esperada' => 'Cantidad Esperada',
            'cantidad_defectuasa' => 'Cantidad Defectuasa',
            'cantidad_entregada' => 'Cantidad Entregada',
            'cantidad_actual' => 'Cantidad Actual',
            'precio_unidad' => 'Precio Unidad',
            'precio_mayor' => 'Precio Mayor',
            'estado' => 'Estado',
            'codigo_barras' => 'Codigo Barras',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemFacturas()
    {
        return $this->hasMany(ItemFactura::className(), ['producto' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto0()
    {
        return $this->hasOne(Producto::className(), ['codigo' => 'producto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalla0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'talla']);
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
    public function getTipo0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalle0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'detalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventario0()
    {
        return $this->hasOne(Inventario::className(), ['codigo' => 'inventario']);
    }
}
