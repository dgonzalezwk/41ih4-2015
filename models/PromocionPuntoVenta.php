<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promocion_punto_venta".
 *
 * @property integer $codigo
 * @property integer $punto_venta
 * @property integer $promocion
 * @property integer $estado
 *
 * @property PuntoVenta $puntoVenta
 * @property Promocion $promocion0
 */
class PromocionPuntoVenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocion_punto_venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['punto_venta', 'promocion', 'estado'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'punto_venta' => 'Punto Venta',
            'promocion' => 'Promocion',
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
    public function getPromocion0()
    {
        return $this->hasOne(Promocion::className(), ['codigo' => 'promocion']);
    }
}
