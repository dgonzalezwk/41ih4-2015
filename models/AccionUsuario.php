<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accion_usuario".
 *
 * @property integer $codigo
 * @property integer $accion
 * @property integer $usuario
 * @property boolean $estado
 *
 * @property Accion $accion0
 * @property Usuario $usuario0
 */
class AccionUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accion', 'usuario'], 'required'],
            [['accion', 'usuario'], 'integer'],
            [['estado'], 'boolean']
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
            'usuario' => 'Usuario',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccion0()
    {
        return $this->hasOne(Accion::className(), ['codigo' => 'accion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario']);
    }
}
