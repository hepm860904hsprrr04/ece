<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Historial de Conversación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat'), 'url' => ['/chat/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="aliado-index">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'mensaje_id',
			'hilo_id',
            'mensaje_texto', 
			'alias',
			'fecha_creacion'
        ],
    ]); ?>

</div>
