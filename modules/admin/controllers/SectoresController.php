<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Sector;
use app\models\BuscadorSector;
use app\models\BuscadorSectorUsuario;
use app\models\FormularioSectorUsuario;
use app\models\SectorUsuario;

use  app\modules\admin\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SectoresController implements the CRUD actions for Sector model.
 */
class SectoresController extends AppController
{
    public $layout = 'main';    

    /**
     * Lists all Sector models.
     * @return mixed
     */
    public function actionIndex()
    {       			
        $searchModel = new BuscadorSector();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,            
        ]);
    }

    /**
     * Displays a single Sector model.
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
     * Creates a new Sector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Sector();
        if ($model->load(Yii::$app->request->post())  && $model->save()) {            
            return $this->redirect(['index']);
        } else {		
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Sector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sector_industrial_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Metodo para asignar un sectorialista a un sector
     * @param integer $sector_id Indica el id del sector al que se asignan los sectorialistas
     */
    public function actionAsignarSectorialista($sector_id=0){
        $objSector = BuscadorSector::obtenerSectorPorId($sector_id);
        if($objSector==null){
            Yii::$app->session->setFlash ('warning',Yii::t('app', 'El sector seleccionado es invalido.') );
            return $this->redirect(['/admin/sectores/index']);
        }        
        $objBuscadorSectorUsuario = new BuscadorSectorUsuario();
        $dataProvider = $objBuscadorSectorUsuario->search(Yii::$app->request->queryParams);
        
        $objFormularioSectorUsuario=new FormularioSectorUsuario();
        $objFormularioSectorUsuario->sector_industrial_id=$sector_id;
        if ($objFormularioSectorUsuario->load(Yii::$app->request->post()) && $objFormularioSectorUsuario->save()) {
            $_SESSION['ece_admin']['sectores_asignados']=BuscadorSectorUsuario::obtenerSectoresAsignadosPorUsuarioId($_SESSION['ece_admin']['usuario_id']);            
            Yii::$app->session->setFlash ('success',Yii::t('app', 'El sector fue agregado al sectorialista correctamente.') );
             return $this->redirect(['/admin/sectores/asignar-sectorialista','sector_id'=>$sector_id]);
        }
        
        return $this->render('asignar_sectorialista', [
            'searchModel' => $objBuscadorSectorUsuario,
            'dataProvider' => $dataProvider,            
            'objSector' => $objSector,
            'objFormularioSectorUsuario'=>$objFormularioSectorUsuario,
            'sector_id'=>$sector_id
        ]);        
    }
    
    public function actionRemoverSectorialista($sector_id=0,$sectorialista_id=0){
        if(SectorUsuario::deleteAll(['sector_industrial_id'=>$sector_id,'usuario_id'=>$sectorialista_id])){
            $_SESSION['ece_admin']['sectores_asignados']=BuscadorSectorUsuario::obtenerSectoresAsignadosPorUsuarioId($_SESSION['ece_admin']['usuario_id']);            
            Yii::$app->session->setFlash ('success',Yii::t('app', 'El sectorialista fue removido correctamente.') );            
        }else{
            Yii::$app->session->setFlash ('warning',Yii::t('app', 'El sectorialista no pudo ser removido.') );            
        }
        return $this->redirect(['/admin/sectores/asignar-sectorialista','sector_id'=>$sector_id]);            
    }

    /**
     * Deletes an existing Sector model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    */

    /**
     * Finds the Sector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sector::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
}
