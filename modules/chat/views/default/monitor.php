<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Monitor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat'), 'url' => ['/chat/default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
$script = <<< JS
$(document).ready(function() {          
  setInterval(function(){  obtenerUsuarios(); }, 3000);   
  obtenerUsuarios();
    function obtenerUsuarios(){
        $.ajax({
            url: "?r=chat/default/obtener-usuarios-conectados",
            method:'get',            
        }).done(function(response) {            
           $("#usuarios-espera").html(response);
        });             
    }
 
});
JS;
$this->registerJs($script);
?>

<div id="usuarios-espera">

</div>