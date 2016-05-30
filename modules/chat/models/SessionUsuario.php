<?php

namespace app\modules\chat\models;

use Yii;
use yii\base\Model;
use app\modules\chat\models\Hilo;
use app\modules\chat\models\Mensaje;

class SessionUsuario extends Model
{      
    
    public static function obtenerSessionId(){
        return isset($_SESSION['ece_admin']['usuario_id']) ? ''.$_SESSION['ece_admin']['usuario_id'] : '';
    }   
    
    public static function obtenerNombre(){
        if(isset($_SESSION['ece_admin']['nombre'])) 
		return $_SESSION['ece_admin']['nombre'] ;
		
		
        if(isset($_SESSION['ece_admin']['usuario'])) 
		return $_SESSION['ece_admin']['usuario'] ;	

		return "No disponible";
    }     
    
    /**
     * 
     * @return Hilo Instance if the hilo exists
     */
    public static function obtenerHilo($hilo_id=0){
        return Hilo::find()->where(['usuario_session_id'=>  self::obtenerSessionId(),'hilo_id'=>$hilo_id])->one();
    }
    
    
    public static function obtenerMensajes($hilo_id=0){
        $objHilo=self::obtenerHilo($hilo_id);

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