<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Canton;
use app\models\AppModel;



/**
 * BuscadorCanton represents the model behind the search form about `app\models\Canton`.
 */
class BuscadorCanton extends Canton
{
    /**
     * @inheritdoc
     */
    public function rules()
    {        
        return [
            
            [['canton_id', 'nombre'], 'required'],
           [['canton_id', 'nombre'], 'safe'],
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
     *   Metodo que devuelve cantones por provincia 
     **/
    public static function obtenerCantonesPorProvincia($provincia_id=0){  	
         $cantones = self::find()    
        ->select('canton_id,nombre')
        ->orderBy('nombre')
        ->where('provincia_id='.$provincia_id)
        ->all();  
        return ArrayHelper::map($cantones,'canton_id','nombre');                    
    }	    

    
}
