<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\widgets\Spinner;

$this->title = Yii::t('app', 'Formulario de Confirmación');
$this->params['breadcrumbs'][] = ['label' =>Yii::t('app', 'Mostrar Cesta'), 'url' => ['/site/mostrar-cesta']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="panel panel-primary">
  	<div class="panel-heading">
            <?php echo Yii::t('app', ' Información del Candidato');?>
            <div class="btn-group btn-group-xs pull-right" role="group" aria-label="..."> <a href="<?php echo Url::to(['/site/borrar-session']);?>" class="btn btn-danger"> Registrar otra Cuenta </a> </div>
        </div>	
	<?php echo  DetailView::widget([
        'model' => $objCandidato,
        'attributes' => [             
            'ruc',  
            'razon_social',                
            'representante_legal',
            'actividad_general',
            'tipo_contribuyente',            
            'nombre_provincia',
            'nombre_canton',
            'calle',
            'correo_electronico',
                     
        ],
    ]) ?>	
	<div class="panel-footer">
        <div class="btn-group btn-group-sm" role="group"> 
            <a href="#" id="cmdback" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <?php echo Yii::t('app', 'Atras');?></a>
        </div>

        <div class="btn-group btn-group-sm pull-right" role="group">             
            <?php $form = ActiveForm::begin(); ?>		
            <button type="submit" class="btn btn-success" name="cmdenviar"><?php echo Yii::t('app', 'Enviar Postulacion ahora');?>  <span class="glyphicon glyphicon-send" aria-hidden="true"></span> </a>            
            <?php ActiveForm::end(); ?>				
        </div> 			
	</div>	

</div>