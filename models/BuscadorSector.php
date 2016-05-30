<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Sector;
use app\models\AppModel;



/**
 * SectorSearch represents the model behind the search form about `app\models\Sector`.
 */
class BuscadorSector extends Sector
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sector_industrial_id','estado'], 'integer'],
            [['nombre_sector'], 'safe'],                        
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
    public function search($params){
        $query = Sector::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,			
            'sort'=>['defaultOrder' => ['sector_industrial_id' => 'DESC']]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sector_industrial_id' => $this->sector_industrial_id,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'nombre_sector', $this->nombre_sector]);

        return $dataProvider;
    }

    /**
     *   Metodo que devuelve todos los sectores 
     **/
    public static function obtenerSectores(){  	
        $sectores = self::find()    
        ->select('sector_industrial_id,nombre_sector')
        ->orderBy('nombre_sector')
        ->all();   
        return ArrayHelper::map($sectores,'sector_industrial_id','nombre_sector');
    }	


    /**
     *   Metodo que devuelve todos los sectores que tengan por lo menos un producto y que esten activos
     **/	
    public function obtenerSectoresActivosConProductos(){  	
        $sql_string="select * from ec_mipro_ece.vw_sectores_activos_con_productos order by nombre_sector ASC;";
        $sectores=ArrayHelper::map(self::findBySql($sql_string)->all(), 'sector_industrial_id', 'nombre_sector');
        if($sectores!=null){
            foreach($sectores as $key => $val){
                $sectores[$key]=AppModel::sanitizarCadena($val);
            }
            return $sectores;
        }
        return array();
    }
	
	
    /**
     *  Metodo que obtiene una sector activo con productos, filtrado por su id
     * @param type $sector_industrial_id
     * @return type
     */
    public function obtenerSectorActivoConProductosPorId($sector_industrial_id=0){  
        $cadena_consulta="select * from ec_mipro_ece.vw_sectores_activos_con_productos where sector_industrial_id=".$sector_industrial_id." LIMIT 1;";
        $objSector=self::findBySql($cadena_consulta)->one();
        if($objSector!=null){
            $objSector->nombre_sector=AppModel::sanitizarCadena($objSector->nombre_sector);
            return $objSector;
        }
        return  null;
    }
    
    /**
     * Metodo que obtiene un sector
     * @property integer $sector_id Número del sector
     */
    public static function obtenerSectorPorId($sector_id=0){
        $objSector=Sector::findOne($sector_id);
        if($objSector!=null){
           $objSector->nombre_sector=  AppModel::sanitizarCadena($objSector->nombre_sector);
           return $objSector;
        }
        return null;
    }
    
}
