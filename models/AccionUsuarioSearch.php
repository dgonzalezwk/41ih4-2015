<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccionUsuario;

/**
 * AccionUsuarioSearch represents the model behind the search form about `app\models\AccionUsuario`.
 */
class AccionUsuarioSearch extends AccionUsuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'accion', 'usuario'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AccionUsuario::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'codigo' => $this->codigo,
            'accion' => $this->accion,
            'usuario' => $this->usuario,
        ]);

        return $dataProvider;
    }

    public static function isValido( $accion , $usuario )
    {
        $result = AccionUsuario::find()->where( [ 'accion'=>$accion->codigo , 'usuario'=>$usuario->codigo ] )->all();
        if ( isset( $result ) && count($result) > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public static function accionPorUsuario( $accion , $usuario )
    {
        $result = AccionUsuario::find()->where( [ 'accion'=>$accion->codigo , 'usuario'=>$usuario->codigo ] )->one();
        if ( isset( $result ) && count($result) > 0 ) {
            return $result;
        } else {
            return false;
        }
    }
}
