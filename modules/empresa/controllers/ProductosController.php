<?php

namespace app\modules\empresa\controllers;

use Yii;
use app\models\Producto;
use app\models\BuscadorProducto;

use  app\modules\empresa\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * 	ProductosController implements the CRUD actions for Producto model.
 */
class ProductosController extends AppController{
    
    public $layout = 'main';

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex(){          
        $objBuscadorProducto = new BuscadorProducto();
        $dataProvider = $objBuscadorProducto->obtenerProductosPorEmpresa(Yii::$app->request->queryParams);
               
        return $this->render('index', [
            'searchModel' => $objBuscadorProducto,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {        
        $objProducto=BuscadorProducto::obtenerProductoPorEmpresaIdProductoId($id);
        if($objProducto==null){
            Yii::$app->session->setFlash ('warning',Yii::t('app', 'El producto no existe.') );
            return $this->redirect(['/empresa/productos/index']); 
        }		
        return $this->render('view', [		
            'objProducto' =>$objProducto,
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $objProducto = new Producto();
		
        if ($objProducto->load(Yii::$app->request->post()) && $objProducto->validate()) {
            $objProducto->creado_por=isset($_SESSION['ece_empresa']['usuario_id']) ? $_SESSION['ece_empresa']['usuario_id'] : null;
            $objProducto->empresa_id=isset($_SESSION['ece_empresa']['empresa_id']) ? $_SESSION['ece_empresa']['empresa_id'] : null;
            $objProducto->fecha_creacion=date('Y-m-d H:m:s');

            $file = UploadedFile::getInstance($objProducto, 'imageFile');
            if($file!=NULL && $file->size !== 0){
               $random_name=str_replace(array("."," "), "", microtime()).'.' . $file->extension;
                $file->saveAs(Yii::$app->basePath . Yii::$app->params['ruta_imagen_grande'] .$random_name);
                
                ##Generar thumbnail
                 Image::thumbnail(Yii::$app->basePath .Yii::$app->params['ruta_imagen_grande'].$random_name , 100, 100)
                                ->save(Yii::$app->basePath .Yii::$app->params['ruta_imagen_chica'].$random_name, ['quality' => 50]);                    
                $objProducto->foto=  $random_name ; 
            }

            if($objProducto->save()){
                Yii::$app->session->setFlash ('success',Yii::t('app', 'El producto fue creado exitosamente.') );
                return $this->redirect(['view', 'id' => $objProducto->inventario_id]);
            }else{
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'Por favor, revise el formulario.') );
            } 
			            
        } else {
            return $this->render('create', [
                'objProducto' => $objProducto,
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
        $objProducto = $this->findModel($id);
        if($objProducto==null){
            Yii::$app->session->setFlash ('warning',Yii::t('app', 'El producto no existe.') );
            return $this->redirect(['/empresa/productos/index']); 
        }		
		
        $imagen_actual=$objProducto->foto;
        if ($objProducto->load(Yii::$app->request->post()) && $objProducto->validate()) {
            $objProducto->modificado_por=isset($_SESSION['empresa_ece']['usuario_id']) ? $_SESSION['empresa_ece']['usuario_id'] : 0;					

            $file = UploadedFile::getInstance($objProducto, 'imageFile');

            if($file!=NULL && $file->size !== 0){
                $random_name=str_replace(array("."," "), "", microtime()).'.' . $file->extension;

                if($file->saveAs(Yii::$app->basePath . Yii::$app->params['ruta_imagen_grande'] .$random_name)){
                    if(file_exists (Yii::$app->basePath.Yii::$app->params['ruta_imagen_grande'].$imagen_actual)){
                        unlink(Yii::$app->basePath.Yii::$app->params['ruta_imagen_grande'].$imagen_actual);
                    }

                    if(file_exists (Yii::$app->basePath.Yii::$app->params['ruta_imagen_chica'].$imagen_actual)){
                        unlink(Yii::$app->basePath.Yii::$app->params['ruta_imagen_chica'].$imagen_actual);
                    }
                }

                ##Generar thumbnail
                 Image::thumbnail(Yii::$app->basePath .Yii::$app->params['ruta_imagen_grande'].$random_name , 100, 100)
                                ->save(Yii::$app->basePath .Yii::$app->params['ruta_imagen_chica'].$random_name, ['quality' => 50]);                    
                $objProducto->foto=  $random_name ; 
            }	
            if($objProducto->save()){
                Yii::$app->session->setFlash ('success',Yii::t('app', 'El producto fue actualizado exitosamente.') );
                return $this->redirect(['view', 'id' => $objProducto->inventario_id]);
            }else{
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'Por favor, revise el formulario.') );
            }            
        } else {
            return $this->render('update', [
                'objProducto' => $objProducto,
            ]);
        }
    }


    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        $objProducto = Producto::find()
        ->where(['inventario_id'=>$id,'empresa_id'=>$_SESSION['ece_empresa']['empresa_id']])
        ->one();
        if ($objProducto !== null) {
            return $objProducto;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
