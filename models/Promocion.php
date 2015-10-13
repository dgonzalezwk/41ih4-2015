<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promocion".
 *
 * @property integer $codigo
 * @property integer $producto
 * @property integer $color
 * @property integer $talla
 * @property integer $categoria
 * @property integer $detalle
 * @property integer $pocentaje
 * @property integer $valor_fijo
 * @property string $fecha_inicio
 * @property string $fecha_fin
 *
 * @property Producto $producto0
 * @property Termino $color0
 * @property Termino $talla0
 * @property Termino $categoria0
 * @property Termino $detalle0
 * @property PromocionPuntoVenta[] $promocionPuntoVentas
 */
class Promocion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producto', 'color', 'talla', 'categoria', 'detalle', 'pocentaje', 'valor_fijo'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'required'],
            [['fecha_inicio', 'fecha_fin'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'producto' => 'Producto',
            'color' => 'Color',
            'talla' => 'Talla',
            'categoria' => 'Categoria',
            'detalle' => 'Detalle',
            'pocentaje' => 'Pocentaje',
            'valor_fijo' => 'Valor Fijo',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
        ];
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
    public function getCategoria0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'categoria']);
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
    public function getPromocionPuntoVentas()
    {
        return $this->hasMany(PromocionPuntoVenta::className(), ['promocion' => 'codigo'])->where(['estado' => '1'])->all();
    }
}
