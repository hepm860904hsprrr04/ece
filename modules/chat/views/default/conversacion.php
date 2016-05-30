<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Conversacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat'), 'url' => ['/chat/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Spinner;
?>


<?php
$script = <<< JS
$(document).ready(function() {
    var bandera=0;
        
    setInterval(function(){
        if(bandera==0){
        obtenerMensajes(0);
        }
   }, 3000);
        
    obtenerMensajes(0);
        
    function obtenerMensajes(enviar_mensaje){
        bandera=1;
        var mensaje_enviar="";
        if(enviar_mensaje==0){
            mensaje_enviar="";
        }else{
            mensaje_enviar=$("#txtMensaje").prop("value");
        }
        $.ajax({
            url: "?r=chat/default/obtener-mensajes",
            method:'post',
            data:{mensaje:mensaje_enviar,hilo_id:$("#hilo_id").prop("value")},
        }).done(function(response) {
            var contenedor_mensajes=$("#contenedor-mensajes").html(response);
            if(enviar_mensaje==1){
            $("#txtMensaje").prop("value","");
            }
            bandera=0;
        
            //$("#contenedor-mensajes").scrollTo('div:last', 1000);
            //$('#div').attr('scrollTop', $('#div').attr('scrollHeight'));
            //$("#contenedor-mensajes").scrollTop($("#contenedor-mensajes").height(), 1000);
        $("#contenedor-mensajes").animate({ scrollTop: $('#contenedor-mensajes')[0].scrollHeight}, 1000);

        });  
        
      
    }  
        

      
    $("#sendButton").click(function(){
        obtenerMensajes(1);
    });
      
});
JS;

$this->registerJs($script);
?>
	
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo Html::encode(Yii::t('app', 'Soporte en Linea'));?>
	
	
		<div class="btn-group btn-group-xs pull-right" role="group" aria-label="...">
			<a href="<?php echo Url::to(['/chat/default/terminar','id' =>$hilo_id]);?>" class="btn btn-danger"><?php echo Html::encode(Yii::t('app', 'Terminar Conversacion'));?></a>
		</div>
	
	</div>
	<input type="hidden" name="hilo_id" id="hilo_id" value="<?=$hilo_id;?>">
    <div class="panel-body">
        <div style="height:350px; overflow-y: scroll;" id="contenedor-mensajes">
            
        </div>
    </div>  
    <div class="panel-footer">        
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" placeholder="<?php echo Html::encode(Yii::t('app', 'Escribe tu mensaje aqui.')); ?>" id="txtMensaje">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" id="sendButton"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> </button>
            </span>        
        </div>
    </div>  
</div>