<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\BuscadorReporte;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostulacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reporte de Postulaciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postulacion-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>    
    <p class="text-muted"><?php echo Yii::t('app', 'Postulaciones agrupadas por mes, año');?></p>


    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            
            'ano',
			'mes',
			'total',		 
        ],
    ]); 
	
	$modelo_reporte_postulacion=new BuscadorReporte();
	?>
	
	
	<h3><?php echo  Html::encode("Total de Postulaciones") ?>: <?php echo $modelo_reporte_postulacion->getTotalOfPostulations();?></h3>    
</div>
