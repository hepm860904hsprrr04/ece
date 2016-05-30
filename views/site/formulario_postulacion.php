<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\Spinner;
use yii\helpers\ArrayHelper;

use app\models\AppModel;
use app\models\Cesta;
use app\models\BuscadorProvincia;
use app\models\BuscadorCanton;



$this->title = Yii::t('app', 'Formulario de Postulación');
$this->params['breadcrumbs'][] = ['label' =>Yii::t('app', 'Mostrar Cesta'), 'url' => ['/site/mostrar-cesta']];
$this->params['breadcrumbs'][] = $this->title;

$cantones=array();
if($objCandidato->provincia_id!=null && $objCandidato->canton_id!=null){
    $cantones=BuscadorCanton::obtenerCantonesPorProvincia($objCandidato->provincia_id);
}
?>

<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?php echo Yii::t('app', 'Legal Person');?>
        <div class="btn-group btn-group-xs pull-right" role="group" aria-label="..."> <a href="<?php echo Url::to(['/site/iniciar-session']);?>" class="btn btn-danger"><?php echo  Yii::t('app', '¿ Ya tiene cuenta ?  Presione aquí para iniciar sesión');?> </a> </div>
    </div>
    <div class="panel-body">

        <div class="alert alert-info" id="loading_message" style="display:none;">
            <?php echo Yii::t('app', 'Getting Information...') ?>
           <?php echo Spinner::widget(['preset' => 'small', 'align' => 'right', 'color' => '#23527c']);?>
            <?php echo '<div class="clearfix"></div>';?>
        </div>


        <div class="modules-site-views-default-_register_form">            
            <?php echo $form->field($objCandidato, 'ruc',
            [                            
            ]
            )->label(Yii::t('app', 'RUC / RISE').' *')->textInput(['class' => 'form-control input-sm']); ?>

            <?php echo $form->field($objCandidato, 'razon_social')->textInput(['maxlength' => true,'class' => 'form-control input-sm','readonly'=>true]); ?>
            <?php echo $form->field($objCandidato, 'representante_legal')->textInput(['class' => 'form-control input-sm','readonly'=>true]); ?>
            <?php echo $form->field($objCandidato, 'actividad_general')->textArea(['maxlength' => true,'rows' => '4','style'=>'resize:none;','readonly'=>true]) ?>  
            <?php echo $form->field($objCandidato, 'tipo_contribuyente')->textInput(['class' => 'form-control input-sm','readonly'=>true]); ?>
            <?php echo $form->field($objCandidato, 'telefono_domicilio',
                [
                    'addon' => ['prepend' => ['content'=>'<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>']]
                ]
            )->textInput(['class' => 'form-control input-sm']); ?> 
			
            <?php echo $form->field($objCandidato, 'telefono_celular')->textInput(['class' => 'form-control input-sm','readonly'=>true]); ?>

            <?php echo $form->field($objCandidato, 'correo_electronico',
            [
                'addon' => ['prepend' => ['content'=>'@']]
            ])->textInput(['class' => 'form-control input-sm']); ?>
            <?php echo $form->field($objCandidato, 'provincia_id')->dropdownList(BuscadorProvincia::obtenerProvincias(),
                ['prompt' => Yii::t('app', 'Seleccionar Provincia'),
                 'onchange'=>'
                        $.get( "'.Url::toRoute('site/obtener-cantones-por-provincia').'", { 
                            provincia_id: $(this).val()                          
                            } )                            
                            .done(function( data ) {

                                $( "#'.Html::getInputId($objCandidato, 'canton_id').'" ).html("<option>' .Yii::t('app', 'Seleccionar Canton').'</option>");    

                                $.each(data,function(key,val){
                                   $("<option value="+key+" >"+val+"</option>").appendTo($( "#'.Html::getInputId($objCandidato, 'canton_id').'" ));
                                   // $( "#'.Html::getInputId($objCandidato, 'canton_id').'" ).html( data );
                                }); 
                                
                            }
                        );
                    ' ,    'class' => 'form-control input-sm'           
                ]
            ); ?>            
            <?php echo  $form->field($objCandidato, 'canton_id')->dropdownList($cantones,[ 'prompt' => Yii::t('app', 'Seleccionar Canton'),'class' => 'form-control input-sm']); ?>                                
            <?php echo  $form->field($objCandidato, 'calle')->textArea(['maxlength' => true,'rows' => '3','style'=>'resize:none;']) ?>      			
            <?php echo $form->field($objCandidato, 'numero')->textInput(['class' => 'form-control input-sm']); ?>
            <?php echo $form->field($objCandidato, 'interseccion')->textInput(['class' => 'form-control input-sm']); ?>
            <?php echo $form->field($objCandidato, 'referencia')->textInput(['class' => 'form-control input-sm']); ?>			
            <hr>
            <?php echo  $form->field($objCandidato, 'contrasena')->passwordInput(['class' => 'form-control input-sm']); ?>     
            <?php echo  $form->field($objCandidato, 'confirmacion_contrasena')->passwordInput(['class' => 'form-control input-sm']); ?> 
            <?php //echo  $form->field($objCandidato, 'referencia'); ?> 
        </div>
    </div>
    <div class="panel-footer">
        <div class="btn-group btn-group-sm" role="group"> 
            <a href="<?php echo Url::to(['/site/mostrar-cesta']);?>" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <?php echo Yii::t('app', 'Atras');?></a>
        </div>

        <div class="btn-group btn-group-sm pull-right" role="group">             
            <button type="submit" class="btn btn-success"><?php echo Yii::t('app', 'Postular');?> <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
        </div>        

    </div>
</div>
<?php ActiveForm::end(); ?>

