<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

?>
<h4><?php echo Yii::t('app', 'Clientes en espera');?></h4>
    <?= GridView::widget([
        'dataProvider' => $dataProviderClientes,
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
