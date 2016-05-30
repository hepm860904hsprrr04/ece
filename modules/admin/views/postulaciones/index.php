<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostulacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Postulaciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postulacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'postulacion_id',
            'codigo',
            'inventario',
            'nombre_sector',
            'ruc',
            'razon_social',
            'ip_remota',
            'fecha_creacion',			
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'viewDetail'),
                    ]);
                }
              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {                    
                    return '?r=/admin/postulaciones/view&id='.$model->postulacion_id;
                }
              }
            ], 
        ],
    ]); ?>

</div>
