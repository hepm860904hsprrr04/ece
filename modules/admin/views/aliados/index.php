<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AliadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aliados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sistema'), 'url' => ['/admin/sistema/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="aliado-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo  Html::a(Yii::t('app', 'Crear Aliado'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'aliado_id',
            'nombre_aliado',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'Ver Detalle'),
                    ]);
                }
              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {                    
                    return '?r=admin/aliados/view&id='.$model->aliado_id;
                }
              }
            ], 
        ],
    ]); ?>

</div>
