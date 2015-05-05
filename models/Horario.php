<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "horario".
 *
 * @property integer $codigo
 * @property string $horario_apertura
 * @property string $hora_cierre
 * @property string $hora_max_cierre
 * @property integer $dia
 * @property integer $punto_venta
 *
 * @property PuntoVenta $puntoVenta
 */
class Horario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'horario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['horario_apertura', 'hora_cierre', 'hora_max_cierre', 'dia', 'punto_venta'], 'required'],
            [['horario_apertura', 'hora_cierre', 'hora_max_cierre'], 'safe'],
            [['dia', 'punto_venta'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'horario_apertura' => 'Horario Apertura',
            'hora_cierre' => 'Hora Cierre',
            'hora_max_cierre' => 'Hora Max Cierre',
            'dia' => 'Dia',
            'punto_venta' => 'Punto Venta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuntoVenta()
    {
        return $this->hasOne(PuntoVenta::className(), ['codigo' => 'punto_venta']);
    }
}
