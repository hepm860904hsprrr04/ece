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
            url: "?r=chat/cliente/obtener-mensajes",
            method:'post',
            data:{mensaje:mensaje_enviar},
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

    <?php
        $nombre_imagen="";
        if($objConfig->valor!="" && file_exists (Yii::$app->basePath.'/web/imagenes/config/'.$objConfig->valor)){
            $nombre_imagen="/imagenes/config/".$objConfig->valor;
        }else{
            $nombre_imagen="/imagenes/foto-no-disponible.jpg";
        }

    ?>
	
	
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo Html::encode(Yii::t('app', 'Soporte en Linea'));?></div>
    <div class="panel-body">
		<div class="row">
		  <div class="col-xs-8 col-md-8 col-lg-8">
				<div style="height:350px; overflow-y: scroll;" id="contenedor-mensajes">
					
				</div>		  
		  </div>
		  <div class="col-xs-4 col-md-4 col-lg-4 text-center" >            
				<img class="img-thumbnail" data-src="holder.js/100x100" alt="64x64"  src="<?php echo Yii::getAlias('@web').$nombre_imagen;?>" data-holder-rendered="true"/>  		        
		  </div>
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