<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingreso".
 *
 * @property integer $codigo
 * @property string $fecha_cierre_caja
 * @property string $fecha_llegada
 * @property string $cantidad
 * @property boolean $corresponde
 * @property integer $usuario_pago
 * @property integer $igualado
 * @property integer $suma_anexada
 * @property string $descripcion
 * @property integer $punto_venta
 * @property integer $origen
 * @property integer $destino
 * @property integer $cantidad_esperada
 * @property integer $tipo_ingreso
 * @property integer $estado
 * @property integer $usuario_autorizador 
 * @property integer $usuario_registro
 * @property string $fecha_registro
 * @property integer $usuario_actualizacion
 * @property string $fecha_actualizacion
 *
 * @property Termino $estado0
 * @property Usuario $usuarioPago
 * @property Usuario $usuarioRegistro
 * @property Usuario $usuarioActualizacion
 * @property PuntoVenta $origen0
 * @property PuntoVenta $destino0
 * @property Termino $tipoIngreso
 */
class Ingreso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingreso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_cierre_caja', 'fecha_llegada', 'cantidad', 'usuario_pago', 'suma_anexada', 'descripcion', 'punto_venta', 'origen', 'destino', 'cantidad_esperada', 'tipo_ingreso', 'estado', 'usuario_registro'], 'required'],
            [['fecha_cierre_caja', 'fecha_llegada', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['corresponde', 'igualado'], 'boolean'],
            [['cantidad', 'usuario_pago', 'suma_anexada', 'punto_venta', 'origen', 'destino', 'cantidad_esperada', 'tipo_ingreso', 'estado', 'usuario_registro', 'usuario_actualizacion'], 'integer'],
            [['descripcion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'fecha_cierre_caja' => 'Fecha de salida',
            'fecha_llegada' => 'Fecha Llegada',
            'cantidad' => 'Cantidad',
            'corresponde' => 'Corresponde',
            'usuario_pago' => 'Usuario que entrega',
            'igualado' => 'Igualado',
            'suma_anexada' => 'Suma Anexada',
            'descripcion' => 'Descripcion',
            'punto_venta' => 'Punto Venta',
            'origen' => 'Origen',
            'destino' => 'Destino',
            'cantidad_esperada' => 'Cantidad Esperada',
            'tipo_ingreso' => 'Tipo Ingreso',
            'estado' => 'Estado',
            'usuario_registro' => 'Usuario Registro',
            'fecha_registro' => 'Fecha Registro',
            'usuario_actualizacion' => 'Usuario Actualizacion',
            'fecha_actualizacion' => 'Fecha Actualizacion',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEstado0() 
    { 
        return $this->hasOne(Termino::className(), ['codigo' => 'estado']); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioPago()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_pago']);
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
    public function getUsuarioActualizacion()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_actualizacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigen0()
    {
        return $this->hasOne(PuntoVenta::className(), ['codigo' => 'origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestino0()
    {
        return $this->hasOne(PuntoVenta::className(), ['codigo' => 'destino']);
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getTipoIngreso() 
    { 
        return $this->hasOne(Termino::className(), ['codigo' => 'tipo_ingreso']); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioAutorizador()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario_autorizador']);
    }
}
