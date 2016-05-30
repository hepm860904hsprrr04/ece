<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reporte;

/**
 * BuscadorReporte represents the model behind the search form about `app\models\Reporte`.
 */
class BuscadorReporte extends Reporte
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total','ano', 'mes'], 'integer'],			            
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
	
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_reporte_postulaciones_x_mes';
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
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,			
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'total' => $this->total,
			'ano' => $this->ano,
			'mes' => $this->mes,
        ]);

        //$query->andFilterWhere(['like', 'ano', $this->ano]);
		//$query->andFilterWhere(['like', 'mes', $this->mes]);	

        return $dataProvider;
    }

	
	public function getTotalOfPostulations(){
        $sql_string="select count(*) as total from ec_mipro_ece.postulacion_inventario;";  
		$model=self::findBySql($sql_string)->one();
		if(!$model){
			return 	0;
		}
        return 	$model->total;
	}
}
