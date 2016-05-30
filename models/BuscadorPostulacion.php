<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Postulacion;

/**
 * BuscadorPostulacion represents the model behind the search form about `app\models\Postulacion`.
 */
class BuscadorPostulacion extends Postulacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postulacion_id'], 'integer'],			
            [['ip_remota', 'fecha_creacion','codigo','inventario','ruc','razon_social','nombre_sector'], 'safe'],
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
        return 'ec_mipro_ece.vw_postulacion_inventario';
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
            'sort'=>['defaultOrder' => ['fecha_creacion' => 'DESC']]
        ]);

        $this->load($params);
        
          if($_SESSION['ece_admin']['esAdmin']==false){
            if(isset($_SESSION['ece_admin']['sectores_asignados']) && count($_SESSION['ece_admin']['sectores_asignados'])>0){
                $query->where('sector_industrial_id in ('.implode(',',$_SESSION['ece_admin']['sectores_asignados']).')');
            }else{
                //Si no existe ningun sector asignado al usuario, no se visualiza
                $query->where('0=1');
            }
        }
                

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'postulacion_id' => $this->postulacion_id,
        ]);

        $query->andFilterWhere(['ilike', 'ip_remota', $this->ip_remota]);
		$query->andFilterWhere(['ilike', 'codigo', $this->codigo]);
		$query->andFilterWhere(['ilike', 'inventario', $this->inventario]);
                $query->andFilterWhere(['ilike', 'nombre_sector', $this->nombre_sector]);
		$query->andFilterWhere(['ilike', 'ruc', $this->ruc]);
		$query->andFilterWhere(['ilike', 'razon_social', $this->razon_social]);
		$query->andFilterWhere(['ilike', 'correo_electronico', $this->correo_electronico]);
		$query->andFilterWhere(['ilike', 'fecha_creacion', $this->fecha_creacion]);		

        return $dataProvider;
    }
	
	
	public function getModelById($postulacion_id=0){
            $sql_string="select * from ec_mipro_ece.vw_postulacion_inventario where postulacion_id=".$postulacion_id." LIMIT 1;";                                    
            return  self::findBySql($sql_string)->one(); 	
	}
}
