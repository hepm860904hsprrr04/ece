<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="panel panel-default">
    <div class="panel-heading"><?php echo  Yii::t('app', 'Detalle de Empresa');?></div>
    <div class="panel-body">
<div class="empresa-form">    

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'ruc')->textInput(['maxlength' => true]) ?>

    <?php echo  $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?php echo  $form->field($model, 'nombre_comercial')->textInput(['maxlength' => true]) ?>

    <?php echo  $form->field($model, 'codigo_postal')->textInput(['maxlength' => true]) ?>
    
	<?php echo  $form->field($model, 'estado')->dropdownList(array("ACTIVO"=>"Activo","INACTIVO"=>"Inactivo"), ['prompt' => Yii::t('app', 'Seleccionar')]); ?>		

    <?php echo  $form->field($model, 'correo_electronico')->textInput(['maxlength' => true]) ?>

    <?php echo  $form->field($model, 'observacion')->textArea(['maxlength' => true,'rows' => '5']); ?>

        </div>

    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?php  echo  Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
