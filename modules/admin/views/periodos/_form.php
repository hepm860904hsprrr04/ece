<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Periodo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodo-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo Yii::t('app', 'Periodo');?></div>
        <div class="panel-body">

        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?php  echo  Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>