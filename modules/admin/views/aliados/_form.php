<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aliado */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Html::encode($title);?></div>
    <div class="panel-body">
		<div class="aliado-form">
			<?= $form->field($model, 'nombre_aliado')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?php  echo  Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>