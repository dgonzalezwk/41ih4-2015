<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_inventario".
 *
 * @property integer $codigo
 * @property integer $lote
 * @property integer $inventario
 * @property integer $cantidad_actual
 * @property integer $cantidad_reportada
 * @property boolean $cooresponde
 * @property boolean $igualado
 *
 * @property Lote $lote0
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
            [['lote', 'inventario', 'cantidad_actual', 'cantidad_reportada'], 'required'],
            [['lote', 'inventario', 'cantidad_actual', 'cantidad_reportada'], 'integer'],
            [['cooresponde', 'igualado'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'lote' => 'Lote',
            'inventario' => 'Inventario',
            'cantidad_actual' => 'Cantidad Actual',
            'cantidad_reportada' => 'Cantidad Reportada',
            'cooresponde' => 'Cooresponde',
            'igualado' => 'Igualado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLote0()
    {
        return $this->hasOne(Lote::className(), ['codigo' => 'lote']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventario0()
    {
        return $this->hasOne(Inventario::className(), ['codigo' => 'inventario']);
    }
}
