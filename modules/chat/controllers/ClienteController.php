<?php

namespace app\modules\chat\controllers;

use Yii;
use app\modules\chat\models\SessionCliente;
use app\modules\chat\models\Hilo;
use app\modules\chat\models\Mensaje;
use app\modules\chat\models\BuscadorConfig;

class ClienteController extends \yii\web\Controller
{   
    public $layout = 'main';  
    
    public function actionIndex()
    {    
        $objHilo=SessionCliente::obtenerHilo();
        if($objHilo){
             return $this->redirect(['/chat/cliente/conversacion']);
        }else{
            return $this->redirect(['/chat/cliente/iniciar']);
        }        
    }   

    public function actionIniciar()
    {
		$objHilo=SessionCliente::obtenerHilo();
		if($objHilo){
			return  $this->redirect(['/chat/cliente/conversacion']); 
		}
		
        $objHilo = new Hilo();
         if ($objHilo->load(Yii::$app->request->post())) {                 
                $objHilo->cliente_session_id=  SessionCliente::obtenerSessionId();
                $objHilo->fecha_creacion=date('Y-m-d');
                $objHilo->cliente_ultimo_ping=date('H:m:s');                
                $objHilo->estatus=0;
                $objHilo->estatus_invitacion=0;
                $objHilo->remoto=Yii::$app->request->getUserIP();             
            if($objHilo->save()){ 
				
				//Escribir mensaje de bienvenida
				$objMensaje=new Mensaje();
				$objMensaje->load(Yii::$app->request->post());            
				$objMensaje->mensaje_texto = Yii::t('app', 'Gracias por contactarnos, en breve uno de nuestros operadores le atendera.');
				$objMensaje->hilo_id=$objHilo->hilo_id;
				$objMensaje->tipo=3;//Cliente
				$objMensaje->cliente_session_id=  SessionCliente::obtenerSessionId();
				$objMensaje->alias=   Yii::t('app', 'Sistema');
				
				if($objMensaje->save()){

				} 			
			
                return  $this->redirect(['/chat/cliente/conversacion']);           
            }else{
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Ups! Tenemos un problema para iniciar session, intente nuevamente.'));
            }
        }else{
            if($objHilo->errors){
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Por favor revise el formulario.'));
            }
        }
        
        return $this->render('iniciar',[
            'model'=>$objHilo,
        ]);
    }
    
    public function actionTerminar()
    {
        $objHilo=SessionCliente::obtenerHilo();
        if(!$objHilo){
             return  $this->redirect(['/chat/cliente/']);  
        }
        $objHilo->estatus=2;        
        $objHilo->fecha_cierre=date('Y-m-d');
        
        if($objHilo->save(true, array('fecha_cierre','estatus'))){    

			//Escribir mensaje de finalizacion
			$objMensaje=new Mensaje();			          
			$objMensaje->mensaje_texto = Yii::t('app', 'El visitante finalizo la conversación.');
			$objMensaje->hilo_id=$objHilo->hilo_id;
			$objMensaje->tipo=3;
			$objMensaje->cliente_session_id=  SessionCliente::obtenerSessionId();
			$objMensaje->alias=Yii::t('app', 'Sistema');
			
			
			
			if($objMensaje->save()){

			}else{
			
			} 
				
            session_regenerate_id();
           return  $this->redirect(['/chat/cliente/']);   
        }
    }
	
	
	
    
    public function actionConversacion()
    {
		//Obtener la imagen de logo para el cliente desde la tabla config
		$objConfig=BuscadorConfig::find()->where('config_id=1')->one();
			
		
        return $this->render('conversacion',[
			'objConfig'=>$objConfig
		]);
    }    
	
	

    public function actionObtenerMensajes()
    {
        $this->layout="ajax";
        $request = Yii::$app->request;
        $objHilo=SessionCliente::obtenerHilo();
        if($request->post('mensaje')!=null && $request->post('mensaje')!=""){
            
            $objMensaje=new Mensaje();
            $objMensaje->load(Yii::$app->request->post());            
            $objMensaje->mensaje_texto = $request->post('mensaje');  
            $objMensaje->hilo_id=$objHilo->hilo_id;
            $objMensaje->tipo=1;//Cliente
            $objMensaje->cliente_session_id=  SessionCliente::obtenerSessionId();
            $objMensaje->alias=  $objHilo->cliente_nombre;
            
            if($objMensaje->save()){

            }            
        }
        
        //Actualizar el ping del usuario y marcarlo como activo
        $objHilo->cliente_ultimo_ping=date('Y/m/d H:i:s');
        if($objHilo->save()){
            
        }
        $mensajes=SessionCliente::obtenerMensajes();
        
        return $this->render('obtener-mensajes',[
            'mensajes'=>$mensajes,
        ]);
    }



}
