<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Objeto;
use yii\helpers\ArrayHelper;

/**
 * BuscadorObjeto represents the model behind the search form about `app\modules\admin\models\Objeto`.
 */
class BuscadorObjeto extends Objeto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objeto_id', 'obj_objeto_id', 'sistema_id', 'nivel', 'orden'], 'integer'],
            [['tipo', 'nombre', 'url', 'estado'], 'safe'],
        ];
    }

	
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_objetos';
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
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
				 

        $query->andFilterWhere([
            'objeto_id' => $this->objeto_id,
            'obj_objeto_id' => $this->obj_objeto_id,
            'sistema_id' => $this->sistema_id,
            'nivel' => $this->nivel,
            'orden' => $this->orden,
        ]);

        $query->andFilterWhere(['ilike', 'tipo', $this->tipo])
            ->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'url', $this->url])
            ->andFilterWhere(['ilike', 'estado', $this->estado]);

        return $dataProvider;
    }
	
	
	
    public function getObjetos(){  	
		$objetos = self::find()    
		->orderBy('nombre')
		->all();
		return ArrayHelper::map($objetos,'objeto_id','nombre');
    }
	
}
