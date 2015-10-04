<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemInventario;

/**
 * ItemInventarioSearch represents the model behind the search form about `app\models\ItemInventario`.
 */
class ItemInventarioSearch extends ItemInventario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'producto', 'color', 'talla', 'cantidad_esperada', 'cantidad_defectuasa', 'cantidad_entregada', 'cantidad_actual', 'estado'], 'integer'],
            [['precio_unidad', 'precio_mayor'], 'number'],
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
        $query = ItemInventario::find();

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
            'producto' => $this->producto,
            'color' => $this->color,
            'talla' => $this->talla,
            'cantidad_esperada' => $this->cantidad_esperada,
            'cantidad_defectuasa' => $this->cantidad_defectuasa,
            'cantidad_entregada' => $this->cantidad_entregada,
            'cantidad_actual' => $this->cantidad_actual,
            'precio_unidad' => $this->precio_unidad,
            'precio_mayor' => $this->precio_mayor,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }

    public static function isExist( $producto , $color , $talla , $tipo , $detalle , $inventario ){
        
        $item = ItemInventario::find()->where([ 'producto' => $producto ,'color' => $color , 'talla' => $talla, 'tipo' => $tipo ,'detalle' => $detalle , 'inventario' => $inventario ])->andWhere( ['NOT IN', 'estado', [ TerminoSearch::estadoItemInventarioRemplazado()->codigo , TerminoSearch::estadoItemInventarioEliminado()->codigo ] ] )->one();
        if ( $item != null ) {
            return true;
        } else {
            return false;
        }
    }
    public static function obtenerItem( $producto , $color , $talla , $tipo , $detalle , $inventario ){
        return ItemInventario::find()->where([ 'producto' => $producto ,'color' => $color , 'talla' => $talla, 'tipo' => $tipo ,'detalle' => $detalle , 'inventario' => $inventario ])->andWhere( ['NOT IN', 'estado', [ TerminoSearch::estadoItemInventarioRemplazado()->codigo , TerminoSearch::estadoItemInventarioEliminado()->codigo ] ] )->one();
    }
    public static function obtenerItems( $producto , $color , $talla , $tipo , $detalle , $inventario ){
        return ItemInventario::find()->where([ 'producto' => $producto ,'color' => $color , 'talla' => $talla, 'tipo' => $tipo ,'detalle' => $detalle , 'inventario' => $inventario ])->all();
    }
}
