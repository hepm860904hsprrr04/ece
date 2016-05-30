<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;
use app\modules\admin\models\FormularioIniciarSession;

class AccesoController extends Controller{
    
    public $layout = 'login';	
    
    /**
     * Metodo que permite iniciar session como admin a traves de un formulario
     * @return mixed
     */
    public function actionIniciarSession(){
        $objFormularioIniciarSession = new FormularioIniciarSession();
         if ($objFormularioIniciarSession->load(Yii::$app->request->post()) && $objFormularioIniciarSession->login()) {
            Yii::$app->session->setFlash ('success',Yii::t('app', 'Acceso correcto.'));
            return  $this->redirect(['/admin/default/index']);           
        }else{
            if($objFormularioIniciarSession->errors){
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Por favor revise el formulario.'));
            }
        }

        return $this->render('iniciar_session', [
            'objFormularioIniciarSession' => $objFormularioIniciarSession,
        ]);                
    }
    
    /**
     * Metodo que termina la session de una admin
     * @return mixed
     */
    public function actionCerrarSession(){
        unset($_SESSION['ece_admin']);
        return  $this->redirect(['/admin/acceso/iniciar-session']); 
    }
        
    /**
     * Metodo que permite recuperar la cuenta de una admin
     * @return mixed
     */
    public function actionRecuperarCuenta()
    {
        return $this->render('recuperar_cuenta');
    }    
    
}
