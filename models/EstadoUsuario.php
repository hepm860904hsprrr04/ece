<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class EstadoUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ece_mipro_ece_chat.estado_usuario';
    }
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [		
            [['usuario_id'], 'integer'],
            [['alias','usuario_id','fecha_ultima_conexion','ultimo_ping'], 'safe'],
        ];
        
        return [		
            [['nombre_sector'], 'required'],
            [['estado'], 'integer'],
        ];        
    }    
    
}
