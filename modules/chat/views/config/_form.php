<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\chat\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="panel panel-default">
    <div class="panel-heading"><?php echo Html::encode($title);?></div>
    <div class="panel-body">
		<div class="config-form">
		<?php echo  $form->field($model, 'clave')->textInput(['maxlength' => true,'readonly'=>true]); ?>
		
		
		<?php if($model->valor!="" && file_exists (Yii::$app->basePath.'/web/imagenes/config/'.$model->valor)){?>        
				<img class="img-thumbnail" data-src="holder.js/100x100" alt="64x64" style="width:100px; height: 100px;" src="<?php echo Yii::getAlias('@web')."/imagenes/config/".$model->valor."";?>" data-holder-rendered="true"/>                             
		<?php }else{?>                
				<img class="img-thumbnail" data-src="holder.js/100x100" alt="64x64" style="width:100px; height: 100px;" src="<?php echo Yii::getAlias('@web')."/imagenes/foto-no-disponible.jpg";?>" data-holder-rendered="true"/>
		<?php }?>   
		
		<?php  echo  $form->field($model, 'imageFile')->fileInput() ?>	 		
		 </div>
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?php echo Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>