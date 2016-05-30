<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Spinner;
?>
<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo Html::encode(Yii::t('app', 'Iniciar conversación'));?></div>
    <div class="panel-body">
        <?php echo $form->field($objHilo, 'cliente_nombre',
        [            
        ])->textInput(['id'=>'cliente_nombre','class' => 'form-control input-sm','placeholder'=>Yii::t('app', 'Escriba aqui ...')])->label("Nombre de Usuario:"); ?>        
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?php  echo Html::submitButton(Yii::t('app', 'Iniciar Conversación'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
 <?php ActiveForm::end(); ?>