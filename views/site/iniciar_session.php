<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
$form = ActiveForm::begin([
        'id' => 'login',					
]); ?>		
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo Yii::t('app', 'Iniciar Session');?> </div>
    <div class="panel-body">
        <?php echo $form->field($objFormularioCandidatoAcceso, 'ruc')->textInput()->label(Yii::t('app', 'RUC').' *') ?>
        <?php echo $form->field($objFormularioCandidatoAcceso, 'correo_electronico')->textInput()->label(Yii::t('app', 'Correo Electrónico').' *') ?>
        <?php echo $form->field($objFormularioCandidatoAcceso, 'contrasena')->passwordInput()->label(Yii::t('app', 'Contraseña'.' *')); ?>	
    </div>

    <div class="panel-footer">    		
    <div class="btn-group" role="group" aria-label="...">					
        <?php echo Html::submitButton(Yii::t('app', 'Ingresar'), ['class' => 'btn btn-success']); ?>													
    </div>								
    </div>
</div>
<?php ActiveForm::end() ?>			
