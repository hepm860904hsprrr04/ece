<?php

namespace app\modules\chat\controllers;


use Yii;
use app\modules\admin\controllers\AppController;    

use app\modules\chat\models\BuscadorHilo;
use app\models\Usuario;
use app\modules\chat\models\SessionUsuario;
use app\modules\chat\models\Hilo;
use app\modules\chat\models\Mensaje;
use app\modules\chat\models\EstadoUsuario;
use app\modules\chat\models\BuscadorMensaje;



/**
 * Default controller for the `chat` module
    public $layout = 'chat_admin';  
    public function actionIndex(){    
        //obtener el numero de conversaciones
       // $cadena_consulta="select count(*) as total from ece_mipro_ece_chat.hilo where  usuario_session_id='".SessionUsuario::obtenerSessionId()."'";
        
 */
class DefaultController extends AppController
{

	public $layout = 'chat_admin';
	
	
    /**
     * Renders the index view for the module
     * @return string
     */
	public function actionIndex(){  	 
		
        $total_conversaciones=Hilo::find()->where('estatus=1')->orWhere(['usuario_session_id'=>SessionUsuario::obtenerSessionId(),'cliente_session_id'=>SessionUsuario::obtenerSessionId()])->count();
		//$total_conversaciones=0;
        
		
		//Obtener el estatus del usuario
		$objEstadoUsuario=EstadoUsuario::find()->where(['usuario_id'=>$_SESSION['ece_admin']['usuario_id']])->one();	
		
        return $this->render('index',[     
            'total_conversaciones'=>$total_conversaciones,
			'objEstadoUsuario'=>$objEstadoUsuario,
        ]);
    }

    public function actionConversacion($id=0){  
        $request = Yii::$app->request;
        $hilo_id=$id;  
        $cadena_busqueda="select * from ece_mipro_ece_chat.vw_obtener_visitantes_en_espera where hilo_id=".$hilo_id." limit 1;";
        $existeHilo=  Hilo::findBySql($cadena_busqueda)->one();
//        print_r($_SESSION);
        if($existeHilo){
            $objHilo= BuscadorHilo::find()
                    ->where(['hilo_id'=>$existeHilo->hilo_id])->one();

            $objHilo->usuario_session_id=SessionUsuario::obtenerSessionId();
            $objHilo->usuario_ultimo_ping=date("Y-m-d H:m:s");
            $objHilo->usuario_nombre=SessionUsuario::obtenerNombre();
            $objHilo->estatus=1;
            $objHilo->estatus_invitacion=1;
            $objHilo->fecha_inicio_chat=date("Y-m-d H:m:s");
            
            if($objHilo->save()){
         
            }else{
                print_r($objHilo->errors);
            }
        }
        
        return $this->render('conversacion',[   
			'hilo_id'=>$id
        ]);
    }    
	
    public function actionSendChat() {
        if (!empty($_POST)) {
            echo \sintret\chat\ChatRoom::sendChat($_POST);
        }                
    }
				
    public function actionHistorial(){
        $searchModel = new BuscadorMensaje();
        $dataProvider = $searchModel->obtenerHistorial(Yii::$app->request->queryParams);
        return $this->render('historial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);			
    }				
	
    public function actionMonitor(){    
        $objBuscadorHilo = new BuscadorHilo();
        $dataProviderClientes = $objBuscadorHilo->obtenerClientesEnEspera(Yii::$app->request->queryParams);

        return $this->render('monitor', [
            'objBuscadorHilo' => $objBuscadorHilo,
            'dataProviderClientes' => $dataProviderClientes,
        ]);        

    }	
    
    
    public function actionObtenerUsuariosConectados()
    {
        $this->layout="ajax";
        $objBuscadorHilo = new BuscadorHilo();
        $dataProviderClientes = $objBuscadorHilo->obtenerClientesEnEspera(Yii::$app->request->queryParams);
        return $this->render('obtener_usuarios_conectados', [
            'objBuscadorHilo' => $objBuscadorHilo,
            'dataProviderClientes' => $dataProviderClientes,
        ]);          
    }   
    
    
    function actionMisConversaciones(){        
        $objBuscadorHilo = new BuscadorHilo();
        $dataProvider= $objBuscadorHilo->obtenerMisConversaciones(Yii::$app->request->queryParams);
        return $this->render('mis_conversaciones', [
            'objBuscadorHilo' => $objBuscadorHilo,
            'dataProvider' => $dataProvider,
        ]);          
    }
    
	
    public function actionObtenerMensajes()
    {
        $this->layout="ajax";
        $request = Yii::$app->request;
        $objHilo=SessionUsuario::obtenerHilo($request->post('hilo_id'));
		
				// print_r($objHilo);
		// exit();
		
        if($request->post('mensaje')!=null && $request->post('mensaje')!=""){
            
            $objMensaje=new Mensaje();
            $objMensaje->load(Yii::$app->request->post());            
            $objMensaje->mensaje_texto = $request->post('mensaje');  
            $objMensaje->hilo_id=$objHilo->hilo_id;
            $objMensaje->tipo=2;//Operador
            $objMensaje->cliente_session_id=  SessionUsuario::obtenerSessionId();
            $objMensaje->alias=  $objHilo->usuario_nombre;
            
            if($objMensaje->save()){

            }            
        }
        
        //Actualizar el ping del usuario y marcarlo como activo
        $objHilo->usuario_ultimo_ping=date('Y/m/d H:i:s');

        if($objHilo->save()){
            $mensajes=SessionUsuario::obtenerMensajes();
        }
        $mensajes=SessionUsuario::obtenerMensajes($request->post('hilo_id'));
        
        return $this->render('obtener-mensajes',[
            'mensajes'=>$mensajes,
        ]);
    }
	
    
    
    public function actionCambiarEstatus(){
		//Obtener el estatus del usuario
		$objEstadoUsuario=EstadoUsuario::find()->where(['usuario_id'=>$_SESSION['ece_admin']['usuario_id']])->one();
		

		if(!$objEstadoUsuario){
			$objEstadoUsuario=new EstadoUsuario();		
  
			$objEstadoUsuario->usuario_id=$_SESSION['ece_admin']['usuario_id'];
			$objEstadoUsuario->estado ='CONECTADO';			
			$objEstadoUsuario->fecha_ultima_conexion=date('Y-m-d');	
			$objEstadoUsuario->ultimo_ping=date('Y-m-d H:m:s');	
			$objEstadoUsuario->alias=$_SESSION['ece_admin']['usuario'];
			

		}else{
			$objEstadoUsuario->fecha_ultima_conexion=date('Y-m-d');	
			$objEstadoUsuario->ultimo_ping=date('Y-m-d H:m:s');	
			
			if($objEstadoUsuario->estado=="CONECTADO"){
				$objEstadoUsuario->estado="DESCONECTADO";
			}else{
				$objEstadoUsuario->estado="CONECTADO";
			}
		}
		
		if($objEstadoUsuario->save()){
			
		}else{
			
		}
		
		return  $this->redirect(['/chat/default/index']);  	
	}
	
	
	public function actionTerminar($id=0){
		$objHilo=SessionUsuario::obtenerHilo($id);
		
		// print_r($objHilo);
		// exit();
		
		if(!$objHilo){
			Yii::$app->session->setFlash ('danger',Yii::t('app', 'Parametros invalidos !'));
			return  $this->redirect(['/chat/default/index']); 
		}
		
		$objHilo->estatus=2;
		$objHilo->fecha_cierre=date('Y-m-d');
		
		if($objHilo->save()){
		
			//Escribir mensaje de finalizacion
			$objMensaje=new Mensaje();			          
			$objMensaje->mensaje_texto = Yii::t('app', 'El operador finalizo la conversación.');
			$objMensaje->hilo_id=$objHilo->hilo_id;
			$objMensaje->tipo=3;
			$objMensaje->usuario_session_id=  SessionUsuario::obtenerSessionId();
			$objMensaje->alias=Yii::t('app', 'Sistema');
			
			
			
			if($objMensaje->save()){

			}else{
			
			} 
			
		}					
		
		return  $this->redirect(['/chat/default/index']); 
	}
    
	
	
	public function actionConfigurar(){
		
		
        return $this->render('configurar',[   			
        ]);		
	}
    
}
