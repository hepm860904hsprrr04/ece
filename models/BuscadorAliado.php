<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Aliado;

/**
 * BuscadorAliado represents the model behind the search form about `app\models\Aliado`.
 */
class BuscadorAliado extends Aliado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aliado_id'], 'integer'],
            [['nombre_aliado'], 'safe'],
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
        $query = Aliado::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['aliado_id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'aliado_id' => $this->aliado_id,
        ]);
        
        $query->andFilterWhere(['ilike', 'nombre_aliado', $this->nombre_aliado]);

        return $dataProvider;
    }
	
	
    public static function obtenerAliados(){
        $aliados = self::find()    
        ->select('aliado_id,nombre_aliado')
        ->orderBy('nombre_aliado')
        ->all();
        return ArrayHelper::map($aliados,'aliado_id','nombre_aliado');
    }
	
}
