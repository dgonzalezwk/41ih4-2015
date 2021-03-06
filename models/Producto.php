<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\Url;

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
            [['nombre', 'descripcion', 'estado', 'categoria', 'usuarioMod', 'usuarioCreate'], 'required'],
            [['estado', 'categoria', 'usuarioMod', 'usuarioCreate'], 'integer'],
            [[ 'nombre'], 'string', 'max' => 50],
            [[ 'descripcion'], 'string', 'max' => 250],
            [['fechaCreate', 'fechaMod'], 'safe'],
            [['imagen'], 'string', 'max' => 100],
            ['file', 'file', 
                'maxSize' => 1024*1024*1, //1 MB
                'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'png, jpeg, jpg',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
                'maxFiles' => 1,
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

    /**
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile() 
    {
        return isset($this->imagen) ? Yii::$app->basePath . '/web/img/producto/'. $this->imagen : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() 
    {
        // return a default image placeholder if your source avatar is not found
        $imagen = isset($this->imagen) ? $this->imagen : 'default_product.jpg';
        return Url::to('@web/img/producto/'). $imagen;
    }

    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'file');
 
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
 
        // store the source file name
        //$this->filename = $image->name;
        $ext = end((explode(".", $image->name)));
 
        // generate a unique file name
        $this->imagen = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image;
    }
 
    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage() {
        $file = $this->getImageFile();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }
 
        // if deletion successful, reset your file attributes
        $this->imagen = null;
        $this->file = null;
 
        return true;
    }
}
