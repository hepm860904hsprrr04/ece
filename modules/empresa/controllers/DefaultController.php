<?php

namespace app\modules\empresa\controllers;

use app\modules\empresa\controllers\AppController;

class DefaultController extends AppController{
    
    public $layout = 'main';
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionMiPerfil()
    {
        return $this->render('mi_perfil');
    }    
    
    
}
