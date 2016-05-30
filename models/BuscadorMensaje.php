<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\chat\models\Mensaje;

/**
 * BuscadorMensaje represents the model behind the search form about `app\models\Mensaje`.
 */
class BuscadorMensaje extends Mensaje
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['usuario','mensaje_texto','hilo_id'], 'safe'],            
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
    
    public static function obtenerMensajesPorHiloId($hilo_id=0){
       return self::find()            
        ->where('hilo_id='.$hilo_id)        
        ->all();                
    }
    
}
