<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accion".
 *
 * @property integer $codigo
 * @property string $accion
 * @property string $descripcion
 * @property integer $modulo
 * @property integer $key
 *
 * @property Modulo $modulo0
 * @property AccionUsuario[] $accionUsuarios
 */
class Accion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accion', 'descripcion'], 'required'],
            [['modulo'], 'integer'],
            [['descripcion'], 'string','max' => 255],
            [['accion'], 'string','max' => 100],
            [['key'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'accion' => 'Accion',
            'descripcion' => 'Descripcion',
            'modulo' => 'Modulo',
            'key' => 'key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulo0()
    {
        return $this->hasOne(Modulo::className(), ['codigo' => 'modulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionUsuarios()
    {
        return $this->hasMany(AccionUsuario::className(), ['accion' => 'codigo']);
    }
}
