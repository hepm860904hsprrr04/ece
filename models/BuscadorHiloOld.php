<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Hilo;

/**
 * BuscadorHilo represents the model behind the search form about `app\models\Hilo`.
 */
class BuscadorHilo extends Hilo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['usuario','usuario_codificado'], 'safe'],
 
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
     *   Metodo que devuelve todos las partidas 
     **/
    public static function existeHilo(){          
       return self::find()            
        ->where('cliente_session_id=\''.session_id().'\'')
        ->one();        
    }
    
    
    public static function obtenerHilo(){
       return self::find()            
        ->where('cliente_session_id=\''.session_id().'\'')
        ->one();                 
    }
    
    
    public function obtenerUsuariosConectados(){
        $cadena_consulta='select * from ece_mipro_ece_chat.vw_obtener_usuarios_conectados;';
        $query=Hilo::findBySql($cadena_consulta);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['hilo_id' => 'DESC']]
        ]);
        return $dataProvider;
    }
    
    
    /**
     * Function que obtiene una lista de visitantes en espera
     * @return ActiveDataProvider
     */
    public function obtenerVisitantesEnEspera(){
        
        
        $cadena_consulta='select * from ece_mipro_ece_chat.vw_obtener_usuarios_conectados;';
        //$query = Hilo::find();
                
        $query=Hilo::findBySql($cadena_consulta);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['hilo_id' => 'DESC']]
        ]);

            
        //$query->where('estado=1');
        
        return $dataProvider;
    }
    
    
   
    
    
    
}
