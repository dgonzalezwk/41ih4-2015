<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuarioPuntoVenta;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioPuntoVentaSearch extends UsuarioPuntoVenta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'punto_venta', 'estado'], 'safe'],
            [['usuario', 'punto_venta', 'estado'], 'integer']
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
        $query = Usuario::find();

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
            'usuario' => $this->usuario,
            'punto_venta' => $this->punto_venta,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }

    public static function isValido( $puntoVenta , $usuario )
    {
        $result = UsuarioPuntoVenta::find()->where( [ 'usuario'=>$puntoVenta->codigo , 'punto_venta'=>$usuario->codigo ] )->all();
        if ( isset( $result ) && count($result) > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public static function puntoVentaPorUsuario( $puntoVenta , $usuario )
    {
        $result = UsuarioPuntoVenta::find()->where( [ 'usuario'=>$puntoVenta->codigo , 'punto_venta'=>$usuario->codigo ] )->all();
        if ( isset( $result ) && count($result) > 0 ) {
            return $result;
        } else {
            return false;
        }
    }
}
