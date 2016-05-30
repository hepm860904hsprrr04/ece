<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Chat');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-3">     
        <p>
            <a class="btn btn-link" href="<?php echo Url::to(['/chat/default/monitor']);?>">
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>  <?php echo Yii::t('app', 'Monitor');?>
            </a>
        </p>
        <p class="text-muted"><?php echo Yii::t('app', 'Monitor de Usuarios');?></p>                
    </div>
    <div class="col-lg-3">     
        <p>
            <a class="btn btn-link" href="<?php echo Url::to(['/chat/default/historial']);?>">
                <span class="glyphicon glyphicon-book" aria-hidden="true"></span>  <?php echo Yii::t('app', 'Historial');?>
            </a>
        </p>
        <p class="text-muted"><?php echo Yii::t('app', 'Consultar historial de conversaciones.');?></p>                
    </div>  	
    
</div>