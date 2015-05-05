<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $codigo
 * @property integer $nombre
 * @property integer $descripcion
 * @property integer $estado
 * @property integer $categoria
 * @property string $imagen
 * @property string $fechamod
 * @property integer $usuariomod
 *
 * @property ItemFactura[] $itemFacturas
 * @property Lote[] $lotes
 * @property Usuario $usuariomod0
 * @property Termino $estado0
 * @property Termino $categoria0
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'estado', 'categoria', 'imagen', 'fechamod', 'usuariomod'], 'required'],
            [['nombre', 'descripcion', 'estado', 'categoria', 'usuariomod'], 'integer'],
            [['fechamod'], 'safe'],
            [['imagen'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
            'categoria' => 'Categoria',
            'imagen' => 'Imagen',
            'fechamod' => 'Fechamod',
            'usuariomod' => 'Usuariomod',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemFacturas()
    {
        return $this->hasMany(ItemFactura::className(), ['producto' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLotes()
    {
        return $this->hasMany(Lote::className(), ['producto' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariomod0()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuariomod']);
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
    public function getCategoria0()
    {
        return $this->hasOne(Termino::className(), ['codigo' => 'categoria']);
    }
}
