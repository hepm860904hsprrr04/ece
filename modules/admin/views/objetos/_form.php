<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\BuscadorObjeto;

/* @var $this yii\web\View */
/* @var $objObjeto app\modules\admin\models\Objeto */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
	$objBuscadorObjeto=new BuscadorObjeto();
	$objetos=$objBuscadorObjeto->getObjetos();
?>

<div class="objeto-form">
	
    <?php $form = ActiveForm::begin(); ?>

    <?php //echo  $form->field($objObjeto, 'sistema_id')->textInput(); ?>
	<?php  echo  $form->field($objObjeto, 'obj_objeto_id')->dropdownList($objetos, ['prompt' => Yii::t('app', ' - Seleccionar - ')])->label(Yii::t('app', 'Objeto Padre')); ?>    			
    
	<?php  echo  $form->field($objObjeto, 'tipo')->dropdownList(array("Pantalla"=>"Pantalla","Interna"=>"Interna"),[]); ?>

    <?php echo  $form->field($objObjeto, 'nombre')->textInput(['maxlength' => true]); ?>

    <?php echo  $form->field($objObjeto, 'url')->textInput(['maxlength' => true]); ?>    

    <?php echo  $form->field($objObjeto, 'orden')->textInput(); ?>
	<?php  echo  $form->field($objObjeto, 'estado')->dropdownList(array("ACTIVO"=>"Activo","INACTIVO"=>"Inactivo"),[]); ?>

    <div class="form-group">
        <?php echo  Html::submitButton($objObjeto->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $objObjeto->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
