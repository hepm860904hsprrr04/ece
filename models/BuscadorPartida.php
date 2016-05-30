<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Partida;

/**
 * BuscadorPartida represents the model behind the search form about `app\models\Partida`.
 */
class BuscadorPartida extends Partida
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partida_id'], 'integer'],
            [['codigo_partida','codigo_partida_formato','codigo_partida_formato','descripcion'], 'safe'],
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
        $query = Periodo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['partida_id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'partida_id' => $this->partida_id,
        ]);

        $query->andFilterWhere(['ilike', 'codigo_partida_formato', $this->codigo_partida_formato]);
        $query->andFilterWhere(['ilike', 'codigo_partida', $this->codigo_partida]);

        return $dataProvider;
    }
	
    
    /**
     *   Metodo que devuelve todos las partidas 
     **/
    public static function obtenerPartidas(){  
        $partidas = self::find()    
        ->select('partida_id,codigo_partida')
        ->orderBy('codigo_partida')
        ->all();
        return ArrayHelper::map($partidas,'partida_id','codigo_partida');
    }
    
}
