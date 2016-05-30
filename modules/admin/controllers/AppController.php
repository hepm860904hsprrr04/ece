<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Session;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Clase que representa el controlador principal para el admiistrador de una admin
 * Esta clase es padre del resto de los controladores para el modulo admin
 */
class AppController extends Controller{
    public $layout="main";
    public function beforeAction($event){        
            if(isset($_SESSION['ece_admin'])){ 
				return true;			
                $nombre_del_controlador=  "/".$this->module->id."/".strtolower(Yii::$app->controller->id)."/";                
                //echo $nombre_del_controlador;
                if($nombre_del_controlador!="/admin/default/" && (!isset($_SESSION['ece_admin']['permisos_asignados']) || !in_array($nombre_del_controlador,$_SESSION['ece_admin']['permisos_asignados']))){
                    Yii::$app->session->setFlash ('warning',Yii::t('app', 'Su cuenta no tiene permisos a esta pantalla.'));	                    
                   //$this->redirect(['/admin/default/index']);
                     return true;
                }else{               
                    return true;
                }
				 
            }else{
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Por favor, Inicie session en el siguiente formulario.'));	
                $this->redirect(['/admin/acceso/iniciar-session']); 
            }

    }    


}
