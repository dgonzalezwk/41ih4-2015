<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Termino;

/**
 * TerminoSearch represents the model behind the search form about `app\models\Termino`.
 */
class TerminoSearch extends Termino
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'key'], 'integer'],
            [['termino', 'categoria', 'descripcion'], 'safe'],
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
        $query = Termino::find();

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
            'key' => $this->key,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'termino', $this->termino])
            ->andFilterWhere(['like', 'categoria', $this->categoria])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }

    public static function searchCategories()
    {
        return Termino::find()->select('categoria')->where(['estado'=>1])->distinct(true)->all();
    }

    public static function searchSexos()
    {
        return Termino::find()->where(['categoria'=>'sexo','estado'=>1])->all();
    }
    public static function searchEstadosUsuario()
    {
        return Termino::find()->where(['categoria'=>'Estados De Usuario','estado'=>1])->all();
    }
    public static function searchCategoriasProducto()
    {
        return Termino::find()->where(['categoria'=>'Categoria De Producto','estado'=>1])->all();
    }
    public static function searchEstadosProducto()
    {
        return Termino::find()->where(['categoria'=>'Estados De Producto','estado'=>1])->all();
    }
}
