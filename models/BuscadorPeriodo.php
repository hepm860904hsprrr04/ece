<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Periodo;

/**
 * BuscadorPeriodo represents the model behind the search form about `app\models\Periodo`.
 */
class BuscadorPeriodo extends Periodo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['periodo_id'], 'integer'],
            [['descripcion'], 'safe'],
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
            'sort'=>['defaultOrder' => ['periodo_id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'periodo_id' => $this->periodo_id,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
	
    
    /**
     *   Metodo que devuelve todas las unidades
     **/	
    public static function obtenerPeriodos(){  	
        $periodos = self::find()    
        ->select('periodo_id,descripcion')
        ->orderBy('descripcion')
        ->all();
        return ArrayHelper::map($periodos,'periodo_id','descripcion');        
    }    
	    
	
}
