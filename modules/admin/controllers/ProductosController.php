<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Producto;
use app\models\BuscadorProducto;
use  app\modules\admin\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * ProductosController implements the CRUD actions for Producto model.
 */	
class ProductosController extends AppController
{
    public $layout = 'main';


    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BuscadorProducto();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {        
        $model=BuscadorProducto::obtenerProductoPorId($id);
        return $this->render('view', [
            'model' =>$model,
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->creado_por=isset($_SESSION['user_ece']['usuario_id']) ? $_SESSION['user_ece']['usuario_id'] : 0;
            $model->fecha_creacion=date('Y-m-d H:m:s');

            $file = UploadedFile::getInstance($model, 'imageFile');
            if($file!=NULL && $file->size !== 0){
               $random_name=str_replace(array("."," "), "", microtime()).'.' . $file->extension;
                    $file->saveAs(Yii::$app->basePath . Yii::$app->params['ruta_imagen_grande'] .$random_name);

                ##Generar thumbnail
                 Image::thumbnail(Yii::$app->basePath .Yii::$app->params['ruta_imagen_grande'].$random_name , 100, 100)
                                ->save(Yii::$app->basePath .Yii::$app->params['ruta_imagen_chica'].$random_name, ['quality' => 50]);                    
                $model->foto=  $random_name ; 
            }

            if($model->save()){
                    return $this->redirect(['view', 'id' => $model->inventario_id]);
            }else{
                    Yii::$app->session->setFlash ('warning',Yii::t('app', 'Ups, Revise el formulario.') );
            } 
			            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$old_image_name=$model->foto;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				//print_r($model);
				//exit();
			$model->modificado_por=isset($_SESSION['user_ece']['usuario_id']) ? $_SESSION['user_ece']['usuario_id'] : 0;						
			
			$file = UploadedFile::getInstance($model, 'imageFile');

			if($file!=NULL && $file->size !== 0){
				$random_name=str_replace(array("."," "), "", microtime()).'.' . $file->extension;

				if($file->saveAs(Yii::$app->basePath . Yii::$app->params['ruta_imagen_grande'] .$random_name)){
					if(file_exists (Yii::$app->basePath.Yii::$app->params['ruta_imagen_grande'].$old_image_name))
					unlink(Yii::$app->basePath.Yii::$app->params['ruta_imagen_grande'].$old_image_name);

					if(file_exists (Yii::$app->basePath.Yii::$app->params['ruta_imagen_chica'].$old_image_name))
					unlink(Yii::$app->basePath.Yii::$app->params['ruta_imagen_chica'].$old_image_name);

				}

				##Generar thumbnail
				 Image::thumbnail(Yii::$app->basePath .Yii::$app->params['ruta_imagen_grande'].$random_name , 100, 100)
						->save(Yii::$app->basePath .Yii::$app->params['ruta_imagen_chica'].$random_name, ['quality' => 50]);                    
				$model->foto=  $random_name ; 


			}	
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->inventario_id]);
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
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	 /*
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
