<?php

namespace app\models;

use Yii;


class Mensaje extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ece_mipro_ece_chat.mensaje';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [  
            [['mensaje_texto','tipo'], 'required'],              
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mensaje' => Yii::t('app', 'Mensaje'),
        ];
    }	

    
    
    public static function obtenerMensajes($id=0){
        $mensajes = Mensaje::find()            
        ->orderBy('mensaje_id asc')
        ->where(['cliente_session_id'=>session_id(),'cliente_session_id'=>$id])
        ->all();           
    }
}
