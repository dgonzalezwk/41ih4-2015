<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rol;

/**
 * RolSearch represents the model behind the search form about `app\models\Rol`.
 */
class RolSearch extends Rol
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'integer'],
            [['nombre'], 'safe'],
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
        $query = Rol::find();

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

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }

    public static function searchAll()
    {
        return Rol::find()->where(['estado'=>1])->all();
    }

    public static function getAdministrador()
    {
        return Rol::find()->where([ 'nombre' => 'Administrador' , 'estado' => 1])->one();
    }

    public static function getAdministradorPuntoVenta()
    {
        return Rol::find()->where([ 'nombre' => 'Administrador de punto de venta' , 'estado' => 1])->one();
    }
}
