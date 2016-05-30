<?php

namespace app\modules\empresa\controllers;
use Yii;
use yii\web\Controller;
use app\modules\empresa\models\FormularioLogin;

class AccesoController extends Controller{
    
    public $layout = 'login';	
    
    /**
     * Metodo que permite iniciar session como empresa a traves de un formulario
     * @return mixed
     */
    public function actionIniciarSession(){
        $objFormularioLogin = new FormularioLogin();
         if ($objFormularioLogin->load(Yii::$app->request->post()) && $objFormularioLogin->login()) {
            Yii::$app->session->setFlash ('success',Yii::t('app', 'Acceso correcto.'));
            return  $this->redirect(['/empresa/default/index']);           
        }else{
            if($objFormularioLogin->errors){
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Por favor revise el formulario.'));
            }
        }

        return $this->render('iniciar_session', [
            'objFormularioLogin' => $objFormularioLogin,
        ]);                
    }
    
    /**
     * Metodo que termina la session de una empresa
     * @return mixed
     */
    public function actionCerrarSession(){
        unset($_SESSION['ece_empresa']);
        return  $this->redirect(['/empresa/acceso/iniciar-session']); 
    }
        
    /**
     * Metodo que permite recuperar la cuenta de una empresa
     * @return mixed
     */
    public function actionRecuperarCuenta()
    {
        return $this->render('recuperar_cuenta');
    }    
    
}
