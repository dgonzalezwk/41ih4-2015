<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property integer $codigo
 * @property string $modulo
 * @property string $controladores
 * @property boolean $estado
 *
 * @property Acciones[] $acciones
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
            [['modulo', 'controladores'], 'required'],
            [['estado'], 'boolean'],
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
    public function getAcciones()
    {
        return $this->hasMany(Acciones::className(), ['modulo' => 'codigo']);
    }
}
