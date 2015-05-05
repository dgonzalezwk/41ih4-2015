<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemFactura;

/**
 * ItemFacturaSearch represents the model behind the search form about `app\models\ItemFactura`.
 */
class ItemFacturaSearch extends ItemFactura
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'factura', 'producto', 'cantidad'], 'integer'],
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
        $query = ItemFactura::find();

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
            'factura' => $this->factura,
            'producto' => $this->producto,
            'cantidad' => $this->cantidad,
        ]);

        return $dataProvider;
    }
}
