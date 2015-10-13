<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Promocion;

/**
 * PromocionSearch represents the model behind the search form about `app\models\Promocion`.
 */
class PromocionSearch extends Promocion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'producto', 'color', 'talla', 'categoria', 'detalle', 'pocentaje', 'valor_fijo'], 'integer'],
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
        $query = Promocion::find();

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
            'producto' => $this->producto,
            'color' => $this->color,
            'talla' => $this->talla,
            'categoria' => $this->categoria,
            'detalle' => $this->detalle,
            'pocentaje' => $this->pocentaje,
            'valor_fijo' => $this->valor_fijo,
        ]);

        return $dataProvider;
    }
}
