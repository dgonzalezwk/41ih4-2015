<?php

namespace app\models;

use Yii;
use app\models\Modulo;

/**
 * This is the model class for table "accion".
 *
 * @property integer $codigo
 * @property string $accion
 * @property string $descripcion
 * @property integer $modulo
 * @property string $key
 *
 * @property Modulo $modulo0
 * @property AccionUsuario[] $accionUsuarios
 */
class Accion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accion', 'descripcion', 'key'], 'required'],
            [['modulo'], 'integer'],
            [['accion'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 250],
            [['key'], 'string', 'max' => 30]
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
            'descripcion' => 'Descripcion',
            'modulo' => 'Modulo',
            'key' => 'Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulo0()
    {
        return $this->hasOne(Modulo::className(), ['codigo' => 'modulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionUsuarios()
    {
        return $this->hasMany(AccionUsuario::className(), ['accion' => 'codigo']);
    }

    public static function actionByKey( $key )
    {
        return Accion::find()->where([ 'key' => $key ])->one();
    }

}
