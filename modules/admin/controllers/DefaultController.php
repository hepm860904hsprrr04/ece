<?php

namespace app\modules\admin\controllers;

use app\modules\admin\controllers\AppController;
use Yii;

class DefaultController extends AppController{
    

    
    public function actionIndex()
    {   
        
           // Yii::$app->session->setFlash ('success',Yii::t('app', 'Acceso correcto.'));

//        print_r($_SESSION);
        return $this->render('index');
    }
    
    
    
    
    
}
