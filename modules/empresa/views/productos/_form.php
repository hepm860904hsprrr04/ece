<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BuscadorSector;
use app\models\BuscadorPeriodo;
use app\models\BuscadorUnidad;
use app\models\BuscadorPartida;
//use app\models\BuscadorAliado;
						
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo Yii::t('app', 'Datos del Producto');?></div>
    <div class="panel-body">
<div class="inventario-form">	
	
    <?php echo  $form->field($model, 'codigo')->textInput(['maxlength' => true]); ?>	
    <?php echo  $form->field($model, 'inventario')->textInput(['maxlength' => true]); ?>
    <?php echo  $form->field($model, 'descripcion')->textArea(['maxlength' => true,'rows' => '5']) ?> 
    <?php if($model->foto!="" && file_exists (Yii::$app->basePath.'/web/imagenes/thumbnail/'.$model->foto)){?>        
            <img class="img-thumbnail" data-src="holder.js/64x64" alt="64x64" style="width:64px;" src="<?php echo Yii::getAlias('@web')."/imagenes/thumbnail/".$model->foto."";?>" data-holder-rendered="true"/>                             
    <?php }else{?>                
            <img class="img-thumbnail" data-src="holder.js/64x64" alt="64x64" style="width:64px;" src="<?php echo Yii::getAlias('@web')."/imagenes/foto-no-disponible.jpg";?>" data-holder-rendered="true"/>
    <?php }?>  	
    <?php echo $form->field($model, 'imageFile')->fileInput() ?>	
    <?php echo  $form->field($model, 'sector_industrial_id')->dropdownList(BuscadorSector::obtenerSectores(), ['prompt' => Yii::t('app', 'Seleccionar')]); ?>	
    <?php echo  $form->field($model, 'unidad_id')->dropdownList(BuscadorUnidad::obtenerUnidades(), ['prompt' => Yii::t('app', 'Seleccionar')]); ?>	
    <?php echo  $form->field($model, 'periodo_id')->dropdownList(BuscadorPeriodo::obtenerPeriodos(), ['prompt' => Yii::t('app', 'Seleccionar')]); ?>	
    <?php echo  $form->field($model, 'partida_id')->dropdownList(BuscadorPartida::obtenerPartidas(), ['prompt' => Yii::t('app', 'Seleccionar')]); ?>	
    <?php //echo  $form->field($model, 'aliado_id')->dropdownList(BuscadorAliado::obtenerAliados(), ['prompt' => Yii::t('app', 'Seleccionar')]);?>		
    <?php echo  $form->field($model, 'anexo')->textInput(); ?>
    <?php echo  $form->field($model, 'ubicacion_necesidad_id')->textInput(); ?>	
    <?php echo  $form->field($model, 'volumen_minimo')->textInput(); ?>
    <?php echo  $form->field($model, 'volumen_maximo')->textInput(); ?>
    <?php echo  $form->field($model, 'precio_referencia_min')->textInput(); ?>
    <?php echo  $form->field($model, 'precio_referencia_maximo')->textInput(); ?>
    <?php echo  $form->field($model, 'observaciones')->textArea(['maxlength' => true,'rows' => '5']); ?> 
    <?php echo  $form->field($model, 'publicado')->checkbox(); ?> 
	
        </div>

    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?php  echo  Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
