<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
        <?php
        $form = ActiveForm::begin([
                'id' => 'login',					
        ]); ?>		
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo Yii::t('app', 'Control de Acceso');?></div>
            <div class="panel-body">                
                <?php echo $form->field($objFormularioIniciarSession, 'nombre_usuario')->textInput()->label(Yii::t('app', 'Nombre de Usuario')) ?>
                <?php echo $form->field($objFormularioIniciarSession, 'contrasena')->passwordInput()->label(Yii::t('app', 'Contraseña')); ?>	
            </div>

            <div class="panel-footer">    		
                <div class="btn-group" role="group" aria-label="...">					
                    <?php echo Html::submitButton(Yii::t('app', 'Iniciar'), ['class' => 'btn btn-success']); ?>													
                </div>								
            </div>
        </div>
    <?php ActiveForm::end() ?>			
    </div>
</div>