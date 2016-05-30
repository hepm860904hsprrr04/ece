<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Spinner;
?>


<?php
$script = <<< JS
$(document).ready(function() {
        /*
    setInterval(function(){
        obtenerMensajes();
   }, 3000);
        
    obtenerMensajes();
        
    function obtenerMensajes(){
        $.ajax({
            url: "?r=chat/default/obtener-mensajes",    
            data:{id:},
        }).done(function(response) {
            $("#contenedor-mensajes").html(response);          
        });       
    }        
    */
        
    $("#sendButton").click(function(){
        $.ajax({
            url: "?r=chat/default/agregar-mensaje",
            method:'post',
            data:{mensaje:$("#txtMensaje").prop("value")},
        }).done(function(response) {
            $("#contenedor-mensajes").html(response);
            $("#txtMensaje").prop("value","");
        });
    });
        
});
JS;

$this->registerJs($script);
?>

<div class="panel panel-primary">
    <div class="panel-heading"><?php echo Html::encode(Yii::t('app', 'Soporte en Linea'));?></div>
    <div class="panel-body">
        <div style="height:350px; overflow-y: scroll;" id="contenedor-mensajes">
            
        </div>
    </div>  
    <div class="panel-footer">        
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="<?php echo Html::encode(Yii::t('app', 'Escribe tu mensaje aqui.')); ?>" id="txtMensaje">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" id="sendButton"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> </button>
            </span>        
        </div>
    </div>  
</div>
