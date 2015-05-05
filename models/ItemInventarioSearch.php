<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemInventario;

/**
 * ItemInventarioSearch represents the model behind the search form about `app\models\ItemInventario`.
 */
class ItemInventarioSearch extends ItemInventario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'lote', 'inventario', 'cantidad_actual', 'cantidad_reportada'], 'integer'],
            [['cooresponde', 'igualado'], 'boolean'],
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
        $query = ItemInventario::find();

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
            'lote' => $this->lote,
            'inventario' => $this->inventario,
            'cantidad_actual' => $this->cantidad_actual,
            'cantidad_reportada' => $this->cantidad_reportada,
            'cooresponde' => $this->cooresponde,
            'igualado' => $this->igualado,
        ]);

        return $dataProvider;
    }
}
