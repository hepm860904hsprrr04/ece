<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\chat\models\BuscadorConfig */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Configurar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat'), 'url' => ['/chat/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'config_id',
            'clave',
            'valor',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update}',
              'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Cambiar Valor'),
                    ]);
                }
              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'update') {                    
                    return '?r=chat/config/update&id='.$model->config_id;
                }
              }
            ],
        ],
    ]); ?>
</div>
