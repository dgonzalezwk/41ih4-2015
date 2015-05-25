<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form about `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'categoria', 'usuarioMod', 'usuarioCreate'], 'integer'],
            [[ 'nombre'], 'string', 'max' => 50],
            [[ 'descripcion'], 'string', 'max' => 250],
            [['imagen', 'fechaCreate', 'fechaMod'], 'safe'],
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
        $query = Producto::find();

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
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
            'categoria' => $this->categoria,
            'fechaCreate' => $this->fechaCreate,
            'fechaMod' => $this->fechaMod,
            'usuarioMod' => $this->usuarioMod,
            'usuarioCreate' => $this->usuarioCreate,
        ]);

        $query->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
}
