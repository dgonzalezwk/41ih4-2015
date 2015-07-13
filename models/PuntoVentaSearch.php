<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PuntoVenta;

/**
 * PuntoVentaSearch represents the model behind the search form about `app\models\PuntoVenta`.
 */
class PuntoVentaSearch extends PuntoVenta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'Whatsapp'], 'integer'],
            [['telefono', 'extension', 'pais', 'ciudad', 'barrio', 'direccion', 'lugar', 'local'], 'safe'],
            [['estado'], 'boolean'],
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
        $query = PuntoVenta::find();

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
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'barrio', $this->barrio])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'lugar', $this->direccion])
            ->andFilterWhere(['like', 'local', $this->local]);

        return $dataProvider;
    }

    public static function all()
    {
        return PuntoVenta::find()->where(['estado'=>1])->all();
    }

    public static function allNotSelected()
    {
        return PuntoVenta::find()->where([ 'estado' => 1 ])->andWhere( ['NOT IN', 'codigo', [ Yii::$app->user->identity->getPuntoVentaSelected()->punto_venta ] ] )->all();
    }

}
