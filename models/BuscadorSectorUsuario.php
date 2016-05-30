<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SectorUsuario;

/**
 * BuscadorSectorUsuario represents the model behind the search form about `app\modules\admin\models\SectorUsuario`.
 */
class BuscadorSectorUsuario extends SectorUsuario
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_sectores_usuarios';
    }
	
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sector_industrial_id', 'usuario_id', 'sector_usuario_id'], 'integer'],
            [['nombre_sector','nombre','estado'], 'safe'],
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
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['nombre' => 'ASC']]
        ]);

        $this->load($params);
        $query->where('sector_industrial_id='.$params['sector_id']);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', 'nombre_sector', $this->nombre_sector]);
        $query->andFilterWhere(['ilike', 'nombre', $this->nombre]);
		

        return $dataProvider;
    }
    
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sector_industrial_id' => Yii::t('app', 'Sector'),
            'usuario_id' => Yii::t('app', 'Sectorialista'),     
            'nombre' => Yii::t('app', 'Sectorialista'),    
        ];
    }	   
    
    /**
     * Obtiene los sectores asignados a un usuario
     * @param integer $usuario_id Identificador del usuario
     */
    public static function obtenerSectoresAsignadosPorUsuarioId($usuario_id=0){
        $sectores = self::find()    
        ->select('sector_industrial_id')
        ->where('usuario_id='.$usuario_id)
        ->all();         
        if($sectores!=null){
            $sectores_asignados=array();
            foreach($sectores as $sector){
                $sectores_asignados[]=$sector->sector_industrial_id;
            }
            return $sectores_asignados;
        }
        return array();
    }
}
