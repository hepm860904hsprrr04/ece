<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Objeto;
use app\modules\admin\models\BuscadorObjeto;
use  app\modules\admin\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetosController implements the CRUD actions for Objeto model.
 */
class ObjetosController extends AppController
{
    public $layout="main";

    /**
     * Lists all Objeto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $objBuscadorObjeto = new BuscadorObjeto();
        $dataProvider = $objBuscadorObjeto->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'objBuscadorObjeto' => $objBuscadorObjeto,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Objeto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'objObjeto' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Objeto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $objObjeto = new Objeto();

        if ($objObjeto->load(Yii::$app->request->post()) && $objObjeto->save()) {
            return $this->redirect(['view', 'id' => $objObjeto->objeto_id]);
        } else {
            return $this->render('create', [
                'objObjeto' => $objObjeto,
            ]);
        }
    }

    /**
     * Updates an existing Objeto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $objObjeto = $this->findModel($id);

        if ($objObjeto->load(Yii::$app->request->post()) && $objObjeto->save()) {
            return $this->redirect(['view', 'id' => $objObjeto->objeto_id]);
        } else {
            return $this->render('update', [
                'objObjeto' => $objObjeto,
            ]);
        }
    }

    /**
     * Deletes an existing Objeto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Objeto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Objeto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($objObjeto = Objeto::findOne($id)) !== null) {
            return $objObjeto;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
