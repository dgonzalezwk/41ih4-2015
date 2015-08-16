<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventario;

/**
 * InventarioSearch represents the model behind the search form about `app\models\Inventario`.
 */
class InventarioSearch extends Inventario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'punto_venta', 'origen', 'estado', 'usuario_registro', 'usuario_actualizador'], 'integer'],
            [['fecha', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
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
        $query = Inventario::find();

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
            'fecha' => $this->fecha,
            'punto_venta' => $this->punto_venta,
            'origen' => $this->origen,
            'estado' => $this->estado,
            'usuario_registro' => $this->usuario_registro,
            'fecha_registro' => $this->fecha_registro,
            'usuario_actualizador' => $this->usuario_actualizador,
            'fecha_actualizacion' => $this->fecha_actualizacion,
        ]);

        return $dataProvider;
    }
}
