<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;
use app\models\Inventario;
use app\models\TerminoSearch;
use app\models\ItemInventario;

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

    public static function cantidadActual( $producto , $color , $talla , $tipo , $detalle )
    {
        $inventario = Inventario::find()->where([ 'estado' => TerminoSearch::estadoInventarioActivo()->codigo ])->one();
        if ( $inventario != null ) {
            $item = ItemInventario::find()->where([ 'producto' => $producto ,'color' => $color , 'talla' => $talla, 'tipo' => $tipo ,'detalle' => $detalle , 'inventario' => $inventario->codigo ])->andWhere( ['NOT IN', 'estado', [ TerminoSearch::estadoItemInventarioRemplazado()->codigo ] ] )->one();
            if ( $item == null ) {
                return 0;
            } else {
                return $item->cantidad_actual;
            }
        } else {
            $items = ItemInventario::find()->where([ 'producto' => $producto ,'color' => $color , 'talla' => $talla, 'tipo' => $tipo ,'detalle' => $detalle ])->andWhere( ['NOT IN', 'estado', [ TerminoSearch::estadoItemInventarioRemplazado()->codigo ] ] )->all();
            if ( $items != null ) {
                $itemInventario = null;
                $code = 0 ;
                foreach ( $items as $item ) {
                    if( $item->inventario > $code ){
                        $itemInventario = $item;  
                    }
                }
                return $itemInventario->cantidad_actual;
            } else {
                return 0;
            }
        }
    }

}
