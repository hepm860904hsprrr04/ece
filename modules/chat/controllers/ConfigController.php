<?php

namespace app\modules\chat\controllers;

use Yii;
use app\modules\chat\models\Config;
use app\modules\chat\models\BuscadorConfig;
use app\modules\admin\controllers\AppController;  
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BuscadorConfig();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Config model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$old_image_name=$model->valor;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
						
			
			$file = UploadedFile::getInstance($model, 'imageFile');

			if($file!=NULL && $file->size !== 0){
				$random_name=str_replace(array("."," "), "", microtime()).'.' . $file->extension;

				if($file->saveAs(Yii::$app->basePath . Yii::$app->params['ruta_logo_chat'] .$random_name)){
					//if(file_exists (Yii::$app->basePath.Yii::$app->params['ruta_logo_chat'].$old_image_name))
					//unlink(Yii::$app->basePath.Yii::$app->params['ruta_logo_chat'].$old_image_name);
				}

			}	
			
			$model->valor=  $random_name ; 			
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->config_id]);
			}else{
				Yii::$app->session->setFlash ('warning',Yii::t('app', 'Por favor, Revise el formulario.') );
			}            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
