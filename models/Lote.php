<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lote".
 *
 * @property integer $codigo
 * @property string $fecha
 * @property integer $producto
 * @property integer $color
 * @property integer $talla
 * @property string $descripcion
 * @property integer $cantidad_entregada
 * @property integer $cantidad_defectuasa
 * @property integer $cantidad_esperada
 * @property string $precio_unidad
 * @property string $precio_mayor
 * @property integer $origen
 * @property integer $destino
 * @property integer $tipo
 * @property integer $estado
 *
 * @property ItemInventario[] $itemInventarios
 * @property Termino $tipo0
 * @property Termino $estado0
 * @property PuntoVenta $origen0
 * @property PuntoVenta $destino0
 * @property Producto $producto0
 * @property Termino $color0
 * @property Termino $talla0
 */
class Lote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'producto', 'color', 'talla', 'descripcion', 'cantidad_entregada', 'cantidad_defectuasa', 'cantidad_esperada', 'precio_unidad', 'precio_mayor', 'origen', 'destino', 'tipo', 'estado'], 'required'],
            [['fecha'], 'safe'],
            [['producto', 'color', 'talla', 'cantidad_entregada', 'cantidad_defectuasa', 'cantidad_esperada', 'origen', 'destino', 'tipo', 'estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 250],
            [['precio_unidad', 'precio_mayor'], 'string', 'max' => 12]
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
            'producto' => 'Producto',
            'color' => 'Color',
            'talla' => 'Talla',
            'descripcion' => 'Descripcion',
            'cantidad_entregada' => 'Cantidad Entregada',
            'cantidad_defectuasa' => 'Cantidad Defectuasa',
            'cantidad_esperada' => 'Cantidad Esperada',
            'precio_unidad' => 'Precio Unidad',
            'precio_mayor' => 'Precio Mayor',
            'origen' => 'Origen',
            'destino' => 'Destino',
            'tipo' => 'Tipo',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemInventarios()
    {
        return $this->hasMany(ItemInventario::className(), ['lote' => 'codigo']);
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
    public function getEstado0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'estado']);
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
    public function getDestino0()
    {
        return $this->hasOne(PuntoVenta::className(), ['codigo' => 'destino']);
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
}
