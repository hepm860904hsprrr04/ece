<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\chat\models\Config */

$this->title = $model->config_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


        
    <?php
        $nombre_imagen="";
        if($model->valor!="" && file_exists (Yii::$app->basePath.'/web/imagenes/config/'.$model->valor)){
            $nombre_imagen="/imagenes/config/".$model->valor;
        }else{
            $nombre_imagen="/imagenes/foto-no-disponible.jpg";
        }
            
    ?>
	
	
<div class="config-view">

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'config_id',
            'clave',
            'valor',
			array('attribute'=>'foto','value'=>"@web".$nombre_imagen."",'format' => ['image',['width'=>'100','height'=>'100']],),
        ],
    ]); ?>

</div>
