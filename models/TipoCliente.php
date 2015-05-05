<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_cliente".
 *
 * @property integer $codigo
 * @property string $tipo
 * @property integer $cantidad_compras
 *
 * @property Cliente[] $clientes
 */
class TipoCliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'cantidad_compras'], 'required'],
            [['cantidad_compras'], 'integer'],
            [['tipo'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'tipo' => 'Tipo',
            'cantidad_compras' => 'Cantidad Compras',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['tipo' => 'codigo']);
    }
}
