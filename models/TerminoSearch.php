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
    public static function searchColoresProducto()
    {
        return Termino::find()->where(['categoria'=>'Color','estado'=>1])->all();
    }
    public static function searchDetallesProducto()
    {
        return Termino::find()->where(['categoria'=>'Detalle de producto','estado'=>1])->all();
    }
    public static function searchTallasProducto()
    {
        return Termino::find()->where(['categoria'=>'Talla','estado'=>1])->all();
    }
    public static function searchEstadosProducto()
    {
        return Termino::find()->where(['categoria'=>'Estados De Producto','estado'=>1])->all();
    }
    public static function searchTiposGasto()
    {
        return Termino::find()->where(['categoria'=>'Tipos De Gastos','estado'=>1])->all();
    }
    public static function estadoUsuarioActivo()
    {
        return Termino::find()->where(['categoria'=>'Estados De Usuario', 'key'=>1 ,'estado'=>1])->one();
    }
    public static function estadoUsuarioEliminado()
    {
        return Termino::find()->where(['categoria'=>'Estados De Usuario', 'key'=>3 ,'estado'=>1])->one();
    }
    public static function estadoGastoPorAutorizar()
    {
        return Termino::find()->where(['categoria'=>'Estado De Gasto', 'key'=>1 ,'estado'=>1])->one();
    }
    public static function estadoGastoAutorizado()
    {
        return Termino::find()->where(['categoria'=>'Estado De Gasto', 'key'=>2 ,'estado'=>1])->one();
    }
    public static function tiposIngresos()
    {
        return Termino::find()->where(['categoria'=>'Tipo De Ingresos' ,'estado'=>1])->all();
    }
    public static function tipoIngresoCierreCaja()
    {
        return Termino::find()->where(['categoria'=>'Tipo De Ingresos', 'key'=>2 ,'estado'=>1])->one();
    }
    public static function estadosIngresos()
    {
        return Termino::find()->where(['categoria'=>'Estado De Ingresos' ,'estado'=>1])->all();
    }
    public static function estadoIngresoCorrecto()
    {
        return Termino::find()->where(['categoria'=>'Estado De Ingresos', 'key'=>1 ,'estado'=>1])->one();
    }
    public static function estadoIngresoMenor()
    {
        return Termino::find()->where(['categoria'=>'Estado De Ingresos', 'key'=>2 ,'estado'=>1])->one();
    }
    public static function estadoIngresoMayor()
    {
        return Termino::find()->where(['categoria'=>'Estado De Ingresos', 'key'=>3 ,'estado'=>1])->one();
    }
    public static function estadoIngresoAutorizado()
    {
        return Termino::find()->where(['categoria'=>'Estado De Ingresos', 'key'=>4 ,'estado'=>1])->one();
    }
    public static function estadoItemInventarioCompleto()
    {
        return Termino::find()->where(['categoria'=>'Estado De Item Inventario', 'key'=>1 ,'estado'=>1])->one();
    }
    public static function estadoItemInventarioDefectos()
    {
        return Termino::find()->where(['categoria'=>'Estado De Item Inventario', 'key'=>2 ,'estado'=>1])->one();
    }
    public static function estadoItemInventarioIncompleto()
    {
        return Termino::find()->where(['categoria'=>'Estado De Item Inventario', 'key'=>3 ,'estado'=>1])->one();
    }
    public static function estadoInventarioActivo()
    {
        return Termino::find()->where(['categoria'=>'Estado De Inventario', 'key'=>1 ,'estado'=>1])->one();
    }
    public static function estadoInventarioNoActivo()
    {
        return Termino::find()->where(['categoria'=>'Estado De Inventario', 'key'=>1 ,'estado'=>1])->one();
    }

    public static function searchCategoriaProductoByKey( $key )
    {
        return Termino::find()->where(['categoria'=>'Categoria De Producto','estado'=>1,'key'=> $key ])->one();
    }
    public static function searchColorProductoByKey( $key )
    {
        return Termino::find()->where(['categoria'=>'Color','estado'=>1,'key'=> $key ])->one();
    }
    public static function searchDetalleProductoByKey( $key )
    {
        return Termino::find()->where(['categoria'=>'Detalle de producto','estado'=>1,'key'=> $key ])->one();
    }
    public static function searchTallaProductoByKey( $key )
    {
        return Termino::find()->where(['categoria'=>'Talla','estado'=>1,'key'=> $key ])->one();
    }

}
