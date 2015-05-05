<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventario".
 *
 * @property integer $codigo
 * @property string $fecha
 * @property integer $usuario_registro
 * @property string $fecha_registro
 *
 * @property Usuario $usuarioRegistro
 * @property ItemInventario[] $itemInventarios
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'usuario_registro', 'fecha_registro'], 'required'],
            [['fecha', 'fecha_registro'], 'safe'],
            [['usuario_registro'], 'integer']
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
            'usuario_registro' => 'Usuario Registro',
            'fecha_registro' => 'Fecha Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioRegistro()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_registro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemInventarios()
    {
        return $this->hasMany(ItemInventario::className(), ['inventario' => 'codigo']);
    }
}
