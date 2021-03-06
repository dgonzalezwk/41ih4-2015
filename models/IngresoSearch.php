<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ingreso;

/**
 * IngresoSearch represents the model behind the search form about `app\models\Ingreso`.
 */
class IngresoSearch extends Ingreso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'usuario_pago', 'punto_venta', 'origen', 'destino', 'tipo_ingreso', 'estado', 'usuario_registro', 'usuario_actualizacion'], 'integer'],
            [['fecha_cierre_caja', 'fecha_llegada', 'cantidad', 'suma_anexada', 'descripcion', 'cantidad_esperada', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['corresponde', 'igualado'], 'boolean'],
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
        $query = Ingreso::find();

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
            'fecha_cierre_caja' => $this->fecha_cierre_caja,
            'fecha_llegada' => $this->fecha_llegada,
            'corresponde' => $this->corresponde,
            'usuario_pago' => $this->usuario_pago,
            'igualado' => $this->igualado,
            'punto_venta' => $this->punto_venta,
            'origen' => $this->origen,
            'destino' => $this->destino,
            'tipo_ingreso' => $this->tipo_ingreso,
            'estado' => $this->estado,
            'usuario_registro' => $this->usuario_registro,
            'fecha_registro' => $this->fecha_registro,
            'usuario_actualizacion' => $this->usuario_actualizacion,
            'fecha_actualizacion' => $this->fecha_actualizacion,
        ]);

        $query->andFilterWhere(['like', 'cantidad', $this->cantidad])
            ->andFilterWhere(['like', 'suma_anexada', $this->suma_anexada])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'cantidad_esperada', $this->cantidad_esperada]);

        return $dataProvider;
    }

    public static function byFechaCierreCaja( $fecha )
    {
        return Ingreso::find()->where( [ 'fecha_cierre_caja' => $fecha , 'tipo_ingreso' => TerminoSearch::tipoIngresoCierreCaja()->codigo ] )->all();
    }
}
