<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Horario;

/**
 * HorarioSearch represents the model behind the search form about `app\models\Horario`.
 */
class HorarioSearch extends Horario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'dia', 'punto_venta'], 'integer'],
            [['horario_apertura', 'hora_cierre', 'hora_max_cierre'], 'safe'],
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
        $query = Horario::find();

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
            'horario_apertura' => $this->horario_apertura,
            'hora_cierre' => $this->hora_cierre,
            'hora_max_cierre' => $this->hora_max_cierre,
            'dia' => $this->dia,
            'punto_venta' => $this->punto_venta,
        ]);

        return $dataProvider;
    }

    public static function horarioByCodigo( $codigo ){

        return = Horario::find()->where([ 'codigo' => $codigo ])->one();

    }
}
