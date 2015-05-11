<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property integer $codigo
 * @property string $modulo
 * @property string $controladores
 * @property integer $estado
 *
 * @property Accion[] $accions
 */
class Modulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modulo', 'controladores', 'estado'], 'required'],
            [['estado'], 'integer'],
            [['modulo'], 'string', 'max' => 30],
            [['controladores'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'modulo' => 'Modulo',
            'controladores' => 'Controladores',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccions()
    {
        return $this->hasMany(Accion::className(), ['modulo' => 'codigo']);
    }
}
