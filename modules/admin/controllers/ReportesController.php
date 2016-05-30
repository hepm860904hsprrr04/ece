<?php

namespace app\modules\admin\controllers;

use Yii;
use  app\modules\admin\controllers\AppController;
use app\models\BuscadorReporte;

class ReportesController extends AppController
{
    public $layout = 'main';
	
    public function actionIndex()
    {
        $searchModel = new BuscadorReporte();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		        
    }

}
