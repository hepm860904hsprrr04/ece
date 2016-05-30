<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =Yii::t('app', 'Sectores');
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="sector-index">

    <h1><?php echo Html::encode($this->title) ?></h1>    


    <p>
        <?php echo Html::a(Yii::t('app', 'Crear Sector'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            'sector_industrial_id',
            'nombre_sector',

            //['class' => 'yii\grid\ActionColumn'],
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}{asignar}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'View Detail'),
                    ]);
                },
                'asignar' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-user" aria-hidden="true"></span>', $url, [
                                'title' => Yii::t('app', 'Asignar a Sectorialista'),
                    ]);
                }                        
              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {                    
                    return '?r=/admin/sectores/view&id='.$model->sector_industrial_id;
                }
                if ($action === 'asignar') {                    
                    return '?r=/admin/sectores/asignar-sectorialista&sector_id='.$model->sector_industrial_id;
                }                
              }
            ],            
		
        ],
    ]); ?>

</div>