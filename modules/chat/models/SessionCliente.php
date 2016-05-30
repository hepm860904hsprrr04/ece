<?php

namespace app\modules\chat\models;

use Yii;
use yii\base\Model;
use app\modules\chat\models\Hilo;
use app\modules\chat\models\Mensaje;

class SessionCliente extends Model
{  
    private $session_name='chat_cliente_id';
    
    public static function obtenerSessionId(){
        return session_id();
    }
    
    
    public static function crearSessionCliente(){
        return isset($_SESSION['chat_cliente_id']) ? $_SESSION['chat_nombre_cliente'] : 'No Disponible';
    }
      
    /*
    public static function (){
        $objHilo=Hilo::find()->where(['cliente_session_id'=>  self::obtenerSessionId()])->one();
        if(!$objHilo){
            $objHilo=new Hilo();
            $objHilo->fecha_creacion=date('Y-m-d');
            $objHilo->cliente_ultimo_ping=date('H:m:s');
            $objHilo->cliente_nombre=  self::obtenerNombreCliente();
            $objHilo->estatus=0;
            $objHilo->estatus_invitacion=0;
            $objHilo->remoto=Yii::$app->request->getUserIP();
            $objHilo->save();
        }
        
        return $objHilo;
    }
    */
    
    /**
     * 
     * @return Hilo Instance if the hilo exists
     */
    public static function obtenerHilo(){
        return Hilo::find()->where(['cliente_session_id'=>  self::obtenerSessionId()])->one();
    }
    
    
    public static function obtenerMensajes(){
        $objHilo=self::obtenerHilo();

        if(!$objHilo){
            return array();
        }
        
 $mensajes=Mensaje::find()
    ->where(['hilo_id' => $objHilo->hilo_id])
    ->orderBy('hilo_id DESC')
    ->all();

       return $mensajes;
    }
    
}  