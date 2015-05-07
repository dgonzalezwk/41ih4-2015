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
 * @property Producto[] $productos
 * @property Rol $rol0
 * @property Termino $sexo0
 * @property Termino $estado0
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            'contrasena' => 'Contrasena',
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
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['usuariomod' => 'codigo']);
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

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['usuario' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->codigo;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->contrasena;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->contrasena === base64_encode($password);
    }    
}
