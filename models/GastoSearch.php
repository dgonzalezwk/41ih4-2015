<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gasto;

/**
 * GastoSearch represents the model behind the search form about `app\models\Gasto`.
 */
class GastoSearch extends Gasto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'usuario', 'tipo_gasto', 'punto_venta', 'usuario_registro', 'usuario_actualizacion', 'usuario_autorizador', 'estado'], 'integer'],
            [['fecha', 'monto', 'descripcion', 'fecha_registro', 'fecha_actualizacion', 'fecha_autorizacion'], 'safe'],
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
        $query = Gasto::find();

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
            'usuario' => $this->usuario,
            'tipo_gasto' => $this->tipo_gasto,
            'punto_venta' => $this->punto_venta,
            'usuario_registro' => $this->usuario_registro,
            'fecha_registro' => $this->fecha_registro,
            'usuario_actualizacion' => $this->usuario_actualizacion,
            'fecha_actualizacion' => $this->fecha_actualizacion,
            'usuario_autorizador' => $this->usuario_autorizador,
            'fecha_autorizacion' => $this->fecha_autorizacion,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'monto', $this->monto])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
