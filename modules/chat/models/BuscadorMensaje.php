<?php

namespace app\modules\chat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\chat\models\Mensaje;
use app\modules\chat\models\SessionUsuario;

/**
 * BuscadorChat represents the model behind the search form about `app\modules\chat\models\Mensaje`.
 */
class BuscadorMensaje extends Mensaje
{



    public function obtenerHistorial($params)
    {        
        $query = Mensaje::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['mensaje_id' => 'DESC']]
        ]);

    
        return $dataProvider;
    }
     
	
}
