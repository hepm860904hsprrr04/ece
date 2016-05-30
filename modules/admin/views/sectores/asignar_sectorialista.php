<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\BuscadorUsuario;

/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = Yii::t('app', 'Asignar Sectorialista');

$this->params['breadcrumbs'][] = ['label' => 'Sectores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $objSector->nombre_sector;
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?php echo Yii::t('app', 'Sector');?> : <?php echo  $objSector->nombre_sector;?></h3>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo  Yii::t('app', 'Sectorialista');?></div>
    <div class="panel-body">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>    
    <?php echo  $form->field($objFormularioSectorUsuario, 'usuario_id')->dropdownList(BuscadorUsuario::obtenerSectorialistas(), ['prompt' => Yii::t('app', 'Seleccionar')])->label(false); ?>	
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?php  echo  Html::submitButton( 'Agregar Sectorialista', ['class' =>'btn btn-success']) ?>
        </div>
    </div>
</div>        
    
<?php ActiveForm::end(); ?>

<?php echo  GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [        
        'nombre',   
        //'estado',
        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{remover_sectorialista}',
          'buttons' => [
            'remover_sectorialista' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-user"></span> '.Yii::t('app', 'Remover Sectorialista'), $url, [
                            'title' => Yii::t('app', 'Remover Sectorialista'),
                ]);
            },/*
            'cambiar_estado' => function ($url, $model) {
                return Html::a(($model->estado=="ACTIVO" ?  "Activo" : "Inactivo"), $url, [
                            'title' => Yii::t('app', 'Cambiar Estado'),
                ]);
            }   */                 
          ],
          'urlCreator' => function ($action, $model, $key, $index) {           
            if ($action === 'remover_sectorialista') {                    
                return '?r=admin/sectores/remover-sectorialista&sector_id='.$model->sector_industrial_id.'&sectorialista_id='.$model->usuario_id;
            } 
          }
        ], 	
    ],
]); ?>