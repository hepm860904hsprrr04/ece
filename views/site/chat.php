<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\widgets\Spinner;
use yii\helpers\ArrayHelper;



$this->title = Yii::t('app', 'Chat');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php /*
$script = <<< JS


        
   $(document).ready(function() {
        
$('body').on('beforeSubmit', 'form#formulario_mensaje', function () {
     var form = $(this);
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
        var form_data=form.serialize();
        form.find(':input').prop('value','');
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form_data,
          success: function (response) {
               // do something with response
          }
     });
     return false;
});
    
    
      
    setInterval(function(){
        obtenerMensajes();
   }, 3000);
        
    obtenerMensajes();
    function obtenerMensajes(){   
        var mensaje=$("#chat_message").prop("value");
        $("#chat_message").prop("value","");
        $.ajax({
            url: "?r=site/obtener-mensajes",
            data:{"mensaje":mensaje},
            method:'post',
        }).done(function(response) {
            $("#container-mensajes").html(response);
            console.log('enviado');
        });     
    }
         
    $("#sendButton").click(function(){
        console.log("test");
        var mensaje=$("#chat_message").prop("value");
        if(mensaje!=""){
            obtenerMensajes(); 
        }
    });   
      
});
JS;
$this->registerJs($script);

*/

/*
?>

<?php $form = ActiveForm::begin(['id'=>'formulario_mensaje']); ?>
<div class="panel panel-primary">
    <div class="panel-heading"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <?php echo Yii::t('app', 'Soporte en Linea');?> </div>
    <div class="panel-body">
        <div style="height:300px;overflow-y:scroll;" id="#container-mensajes">
            
        </div>        
    </div>

    <div class="panel-footer">
    <div class="input-group">
        <input name="txtmensaje" id="chat_message" placeholder="<?=Yii::t('app', 'Escriba aqui...')?> " class="form-control">
        <div class="input-group-btn">
            <button class="btn btn-success btn-send-comment"  id="sendButton"> <?=Yii::t('app', 'Enviar')?> <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
        </div>
    </div>
    </div>        
</div> 

<?php ActiveForm::end(); */ ?>

<?php
echo \sintret\chat\ChatRoom::widget([
	'url' => \yii\helpers\Url::to(['/site/send-chat']),
	'userModel'=>  \app\models\User::className(),
	'userField'=>'avatarImage'
	]
);
?>