<ul style="list-style-type: none;padding: 0;">
<?php
if(isset($mensajes) && !empty($mensajes)){
    foreach($mensajes as $mensaje){
         ?>
    <li style="margin-top:10px;">        
        <h6> 
		<span class="text-muted">
		<?php if($mensaje->tipo==1){
		echo Yii::t('app', 'Visitante')." : ";
		}elseif($mensaje->tipo==2){
			echo Yii::t('app', 'Operador')." : ";
		}
		?> <?php echo $mensaje->alias;?>   
		</span>
		</h6>
        <p style="padding-left:30px;"> <small class="text-muted"><?php echo Yii::t('app', '');?></small> <?php echo $mensaje->mensaje_texto;?> </p> 
    </li> 
         <?php 
    }
}
?>
</ul>
