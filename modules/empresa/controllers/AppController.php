<?php
namespace app\modules\empresa\controllers;

use Yii;
use yii\web\Session;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Clase que representa el controlador principal para el admiistrador de una empresa
 * Esta clase es padre del resto de los controladores para el modulo empresa
 */
class AppController extends Controller{


    public function beforeAction($event){
            if(isset($_SESSION['ece_empresa'])){	
                    return true;
            }else{
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'Por favor, Inicie session en el siguiente formulario.'));	
                $this->redirect(['/empresa/acceso/iniciar-session']); 
            }

    }    


}
