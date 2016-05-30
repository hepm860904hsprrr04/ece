<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Candidato;
use app\models\AppModel;



/**
 * BuscadorCandidato represents the model behind the search form about `app\models\Candidato`.
 */
class BuscadorCandidato extends Candidato
{

    /**
     * @inheritdoc
     */    
    public static function tableName(){
        return 'ec_mipro_ece.vw_candidatos';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['candidato_id','provincia_id','canton_id'], 'integer'],
            [['ruc','razon_social','correo_electronico','estado','contrasena'], 'safe'],                        
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
     *   Metodo que busca un candidato por su ruc y correo electrónico
     * 
     **/
    public static function obtenerCandidatoPorRucCorreoElectronico($ruc="",$correo_electronico=""){  	
        return self::find()    
        ->select('candidato_id,ruc,razon_social,correo_electronico,estado,contrasena')        
        ->where(['ruc'=>$ruc,'correo_electronico'=>$correo_electronico])
        ->one();                        
    }
    
    /**
     *   Metodo que obtiene un candidato por su id
     * 
     **/
    public static function obtenerCandidatoPorId($candidato_id=0){  	
        return self::find()            
        ->where('candidato_id='.$candidato_id)
        ->one();                        
    }    

    
}
