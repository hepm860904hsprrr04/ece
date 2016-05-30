<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Unidad;

/**
 * BuscadorUnidad represents the model behind the search form about `app\models\Unidad`.
 */
class BuscadorUnidad extends Unidad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unidad_id'], 'integer'],
            [['nombre','abreviatura'], 'string'],
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
            'sort'=>['defaultOrder' => ['unidad_id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'unidad_id' => $this->unidad_id,
        ]);

        $query->andFilterWhere(['ilike', 'abreviatura', $this->abreviatura]);
        $query->andFilterWhere(['ilike', 'nombre', $this->nombre]);

        return $dataProvider;
    }
	
	
    /**
     *   Metodo que devuelve todas las unidades
     **/	
    public static function obtenerUnidades(){  	
        $sql_string="select * from ec_mipro_arancel.unidad order by nombre ASC;";
        $unidades=ArrayHelper::map(self::findBySql($sql_string)->all(), 'unidad_id', 'nombre');
        if($unidades!=null){
            foreach($unidades as $key => $val){
                $unidades[$key]=AppModel::sanitizarCadena($val);
            }
            return $unidades;
        }
        return array();         
    } 
    
    
	
}
