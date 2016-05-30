<?php

namespace app\modules\admin\controllers;

use app\modules\admin\controllers\AppController;
use Yii;

class ChatController extends AppController{
    
    public $layout = 'main';
    
    public function actionSendChat() 
    {
        if(!empty($_POST)){
          echo \sintret\chat\ChatRoom::sendChat($_POST);
        }     
    } 
    
    
    public function actionIndex()
    {   
         return $this->render('index');
    }   
    
    public function actionMonitorVisitantes()
    {   
         return $this->render('monitor_visitantes');
    }  
    
    public function actionHistorialConversaciones()
    {   
         return $this->render('monitor_visitantes');
    }       
        
    
    
    
    
}
