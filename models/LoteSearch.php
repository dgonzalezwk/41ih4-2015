<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lote;

/**
 * LoteSearch represents the model behind the search form about `app\models\Lote`.
 */
class LoteSearch extends Lote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'producto', 'color', 'talla', 'cantidad_entregada', 'cantidad_defectuasa', 'cantidad_esperada', 'origen', 'destino', 'tipo', 'estado'], 'integer'],
            [['fecha', 'descripcion', 'precio_unidad', 'precio_mayor'], 'safe'],
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
        $query = Lote::find();

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
            'producto' => $this->producto,
            'color' => $this->color,
            'talla' => $this->talla,
            'cantidad_entregada' => $this->cantidad_entregada,
            'cantidad_defectuasa' => $this->cantidad_defectuasa,
            'cantidad_esperada' => $this->cantidad_esperada,
            'origen' => $this->origen,
            'destino' => $this->destino,
            'tipo' => $this->tipo,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'precio_unidad', $this->precio_unidad])
            ->andFilterWhere(['like', 'precio_mayor', $this->precio_mayor]);

        return $dataProvider;
    }
}
