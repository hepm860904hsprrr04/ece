<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Postulacion;
use app\models\BuscadorPostulacion;
use  app\modules\admin\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostulacionesController implements the CRUD actions for Postulacion model.
 */
class PostulacionesController extends AppController
{

    public $layout = 'main';


    /**
     * Lists all Postulacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BuscadorPostulacion();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Postulacion model.
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
     * Finds the Postulacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Postulacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
		$modelo_postulacion=new BuscadorPostulacion();
        if (($model = $modelo_postulacion->getModelById($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
