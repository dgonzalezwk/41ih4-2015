<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $codigo
 * @property integer $numero_identificacion
 * @property string $nombre
 * @property string $apellido
 * @property integer $sexo
 * @property string $email
 * @property integer $telefono
 * @property integer $tipo
 * @property string $usuario
 * @property string $contrasena
 * @property boolean $estado
 * @property boolean $info
 *
 * @property TipoCliente $tipo0
 * @property Terminos $sexo0
 * @property Factura[] $facturas
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_identificacion', 'tipo', 'usuario', 'contrasena'], 'required'],
            [['numero_identificacion', 'sexo', 'telefono', 'tipo'], 'integer'],
            [['estado', 'info'], 'boolean'],
            [['nombre', 'apellido', 'email', 'usuario'], 'string', 'max' => 30],
            [['contrasena'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'numero_identificacion' => 'Numero Identificacion',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'sexo' => 'Sexo',
            'email' => 'Email',
            'telefono' => 'Telefono',
            'tipo' => 'Tipo',
            'usuario' => 'Usuario',
            'contrasena' => 'Contrasena',
            'estado' => 'Estado',
            'info' => 'Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo0()
    {
        return $this->hasOne(TipoCliente::className(), ['codigo' => 'tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexo0()
    {
        return $this->hasOne(Terminos::className(), ['codigo' => 'sexo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['cliente' => 'codigo']);
    }
}
