<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $codigo
 * @property integer $identificacion
 * @property string $nombre
 * @property string $apellido
 * @property integer $telefono
 * @property string $email
 * @property string $fecha_nacimiento
 * @property integer $sexo
 * @property string $usuario
 * @property string $contrasena
 * @property integer $rol
 * @property integer $estado
 *
 * @property AccionUsuario[] $accionUsuarios
 * @property Factura[] $facturas
 * @property Gasto[] $gastos
 * @property Ingreso[] $ingresos
 * @property Inventario[] $inventarios
 * @property Rol $rol0
 * @property Termino $sexo0
 * @property Termino $estado0
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['identificacion', 'nombre', 'apellido', 'telefono', 'email', 'fecha_nacimiento', 'sexo', 'usuario', 'contrasena', 'rol', 'estado'], 'required'],
            [['identificacion', 'telefono', 'sexo', 'rol', 'estado'], 'integer'],
            [['fecha_nacimiento'], 'safe'],
            [['nombre', 'apellido', 'email', 'usuario', 'contrasena'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'identificacion' => 'Identificacion',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'sexo' => 'Sexo',
            'usuario' => 'Usuario',
            'contrasena' => 'Contraseña',
            'rol' => 'Rol',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionUsuarios()
    {
        return $this->hasMany(AccionUsuario::className(), ['usuario' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['usuario' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGastos()
    {
        return $this->hasMany(Gasto::className(), ['usuario_actualizacion' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresos()
    {
        return $this->hasMany(Ingreso::className(), ['usuario_actualizacion' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['usuario_registro' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol0()
    {
        return $this->hasOne(Rol::className(), ['codigo' => 'rol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexo0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'sexo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'estado']);
    }
}
