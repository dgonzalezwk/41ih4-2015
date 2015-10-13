<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PromocionPuntoVenta;

/**
 * PromocionPuntoVentaSearch represents the model behind the search form about `app\models\PromocionPuntoVenta`.
 */
class PromocionPuntoVentaSearch extends PromocionPuntoVenta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'punto_venta', 'promocion', 'estado'], 'integer'],
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
        $query = PromocionPuntoVenta::find();

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
            'punto_venta' => $this->punto_venta,
            'promocion' => $this->promocion,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }

    public static function isValido( $puntoVenta , $promocion )
    {
        $result = PromocionPuntoVenta::find()->where( [ 'promocion' => $promocion->codigo , 'punto_venta'=> $puntoVenta->codigo ] )->one();
        if ( isset( $result ) ) {
            return true;
        } else {
            return false;
        }
    }

    public static function puntoVentaPorPromocion( $puntoVenta , $promocion )
    {
        $result = PromocionPuntoVenta::find()->where( [ 'promocion' => $promocion->codigo , 'punto_venta' => $puntoVenta->codigo ] )->one();
        if ( isset( $result ) ) {
            return $result;
        } else {
            return false;
        }
    }
}
