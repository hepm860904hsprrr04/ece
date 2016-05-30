<?php

namespace app\modules\chat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\chat\models\Hilo;

use app\modules\chat\models\SessionUsuario;

/**
 * BuscadorChat represents the model behind the search form about `app\modules\chat\models\Hilo`.
 */
class BuscadorHilo extends Hilo
{
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function obtenerClientesEnEspera($params)
    {
        $cadena_consulta="select * from ece_mipro_ece_chat.vw_obtener_visitantes_en_espera";
        $query = Hilo::findBySql($cadena_consulta);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,            
        ]);

        return $dataProvider;
    }
    
    public function obtenerMisConversaciones($params)
    {
        $cadena_consulta="select * from ece_mipro_ece_chat.hilo where cliente_session_id='".SessionUsuario::obtenerSessionId()."' or usuario_session_id='".SessionUsuario::obtenerSessionId()."' and estatus=1";
        $query = Hilo::findBySql($cadena_consulta);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,            
        ]);

        return $dataProvider;	
        
    }    
	
}
