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
                
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  <?php echo Yii::t('app', 'Monitor');?>
            </a>
        </p>
        <p class="text-muted"><?php echo Yii::t('app', 'Clientes en espera');?></p>                
    </div>
    
    <div class="col-lg-3">     
        <p>
            <a class="btn btn-link" href="<?php echo Url::to(['/chat/default/mis-conversaciones']);?>">
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                <?php echo $total_conversaciones.''. Yii::t('app', ' Conversaciones');?>
            </a>
        </p>
        <p class="text-muted"><?php echo Yii::t('app', 'Lista las conversaciones.');?></p>                
    </div>    
    
    <div class="col-lg-3">     
        <p>
            <a class="btn btn-link" href="<?php echo Url::to(['/chat/default/historial']);?>">
                <span class="glyphicon glyphicon-book" aria-hidden="true"></span>  <?php echo Yii::t('app', 'Historial');?>
            </a>
        </p>
        <p class="text-muted"><?php echo Yii::t('app', 'Consultar historial de conversaciones.');?></p>                
    </div>  

    <div class="col-lg-3">     
        <p>
				<?php echo Yii::t('app', 'Estatus:');?>
            <a class="btn btn-link" href="<?php echo Url::to(['/chat/default/cambiar-estatus']);?>">                
				
				<?php 
					
						if($objEstadoUsuario){
							echo $objEstadoUsuario->estado;
						}else{
							echo Yii::t('app', 'DESCONECTADO');
						}

				?>
            </a>
        </p>    
		
    </div>	
    
</div>



<div class="row">
    <div class="col-lg-3">     
        <p>
            <a class="btn btn-link" href="<?php echo Url::to(['/chat/config/index']);?>">                
                
               <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                  <?php echo Yii::t('app', 'Configurar');?>
            </a>
        </p>
        <p class="text-muted"><?php echo Yii::t('app', 'Cambiar el logo, idioma etc..');?></p>                
    </div>
	
    
</div>