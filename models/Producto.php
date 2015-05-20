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
 * @property string $fechaCreate
 * @property string $fechaMod
 * @property integer $usuarioMod
 * @property integer $usuarioCreate
 *
 * @property ItemFactura[] $itemFacturas
 * @property Lote[] $lotes
 * @property Termino $estado0
 * @property Termino $categoria0
* @property Usuario $usuariomod
 */
class Producto extends \yii\db\ActiveRecord
{
    public $file;

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
            [['nombre', 'descripcion', 'estado', 'categoria', 'imagen', 'usuarioMod', 'usuarioCreate'], 'required'],
            [['estado', 'categoria', 'usuarioMod', 'usuarioCreate'], 'integer'],
            [[ 'nombre'], 'string', 'max' => 50],
            [[ 'descripcion'], 'string', 'max' => 250],
            [['fechaCreate', 'fechaMod'], 'safe'],
            [['imagen'], 'string', 'max' => 100],
            ['file', 'file', 
                'skipOnEmpty' => false,
                'uploadRequired' => 'No has seleccionado ningún archivo', //Error
                'maxSize' => 1024*1024*1, //1 MB
                'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'pdf, txt, doc',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
                'maxFiles' => 4,
                'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ],
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
            'file' => 'Imagen',
            'fechaCreate' => 'Fecha de creacion',
            'fechaMod' => 'Fecha de modificacion',
            'usuarioMod' => 'Usuario modificador',
            'usuarioCreate' => 'Usuario creador',
            [
                'file', 'file',
                'skipOnEmpty' => false,
                'uploadRequired' => 'No has seleccionado ningún archivo', //Error
                'maxSize' => 1024*1024*1, //1 MB
                'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'png, jpeg',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
                'maxFiles' => 4,
                'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariomod()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuariomod']);
    }
}
