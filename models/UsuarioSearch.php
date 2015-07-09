<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;
use app\models\TerminoSearch;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'identificacion', 'telefono', 'sexo', 'rol', 'estado'], 'integer'],
            [['nombre', 'apellido', 'email', 'fecha_nacimiento', 'usuario', 'contrasena'], 'safe'],
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
        $query = Usuario::find();

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
            'identificacion' => $this->identificacion,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'sexo' => $this->sexo,
            'rol' => $this->rol,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'usuario', $this->usuario])
            ->andFilterWhere(['like', 'contrasena', $this->contrasena]);

        return $dataProvider;
    }

    public static function all()
    {
        return Usuario::find()->where(['estado'=> TerminoSearch::EstadoUsuarioActivo()->codigo ])-> andWhere( [ 'not', [ 'codigo' => Yii::$app->user->identity->codigo ] ] )->all();
    }

    public static function autorizadoresPuntoVenta( $puntoVenta )
    {
        $accion = AccionSearch::actionByKey( "Gasto-authorizeExpendit-*" );
        $sql = 'select a.* from usuario a inner join usuario_punto_venta b on a.codigo = b.usuario inner join accion_usuario c on a.codigo = c.usuario where a.rol IN('.RolSearch::getAdministrador()->codigo.','.RolSearch::getAdministradorPuntoVenta()->codigo.') and a.estado = '.TerminoSearch::estadoUsuarioActivo()->codigo.' and b.codigo = '.$puntoVenta->codigo.' and c.codigo = '.$accion->codigo.' and c.estado = 1  ';
        return Usuario::findBySql($sql)->all();
    }

}
