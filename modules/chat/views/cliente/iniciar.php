<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\modules\chat\models\Hilo;
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
        <?php
        $form = ActiveForm::begin([                					
        ]); ?>		
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo Yii::t('app', 'Iniciar Session');?></div>
            <div class="panel-body">                
                <?php echo $form->field($model, 'cliente_nombre')->textInput()->label(Yii::t('app', 'Nombre de Usuario')) ?>                
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