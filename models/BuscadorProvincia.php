<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\Provincia;
use app\models\AppModel;



/**
 * BuscadorProvincia represents the model behind the search form about `app\models\Provincia`.
 */
class BuscadorProvincia extends Provincia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provincia_id'], 'integer'],
            [['nombre'], 'safe'],                        
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
     *   Metodo que devuelve todas las provincias 
     **/
    public static function obtenerProvincias(){  
         $provincias = self::find()    
        ->select('provincia_id,nombre')
        ->orderBy('nombre')
        ->all();  
        return ArrayHelper::map($provincias,'provincia_id','nombre');                    
    }	


	

    
}
