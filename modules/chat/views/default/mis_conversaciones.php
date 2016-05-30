<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Mis Conversaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat'), 'url' => ['/chat/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<h4><?php echo Yii::t('app', 'Visitantes');?></h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $objBuscadorHilo,
        'columns' => [
            'cliente_nombre',
            'remoto',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-comment"></span>', $url, [
                                'title' => Yii::t('app', 'Iniciar Conversación'),
                    ]);
                }
              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {                    
                    return '?r=chat/default/conversacion&id='.$model->hilo_id;
                }
              }
            ],
        ],
    ]); ?>
