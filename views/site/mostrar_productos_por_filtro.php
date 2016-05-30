<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use app\models\AppModel;

    $this->params['breadcrumbs'][] =Yii::t('app', 'Resultado de Busqueda');

    //$this->params['breadcrumbs'][] = ['label' => AppModel::sanitizarCadena($objSector->nombre_sector), 'url' => ['/site/mostrar-productos-por-sector','sector_industrial_id'=>1]];    
    
    if(count($productos)<=0){
        
        ?>
        <div class="alert alert-warning" role="alert"><?php echo Yii::t('app', 'No existen productos con ese filtro.');?></div>
<?php 
    }else{
?>

<style>
ul#menu_orden li {
    display:inline;
    padding-right:5px;
}
</style>

<ul id="menu_orden">
    <li><?php echo Yii::t('app', 'Ordenar:');?></li>
    <li><?php echo $sort->link('periodo_descripcion');?></li>
    <li><?php echo $sort->link('volumen_minimo');?></li>
    <li><?php echo $sort->link('volumen_maximo');?></li>
</ul>


<?php
//Mostrar los botones de navegación de paginas
echo LinkPager::widget([
    'pagination' => $paginas,
    'options'=>array('class'=>"pagination pagination-sm")

]);
?>

<?php
//Mostrar los productos pertenecientes al sector
$contador=0;
$flag=false;
foreach ($productos as $producto) {
     // display $producto here
    if($contador==0){
?>	
    <div class="panel panel-default">
        <div class="panel-body" style="padding:5px;">							
            <div class="row">
    <?php 	
    $flag=true;
    }
    
    $descripcion_corta_producto=(strlen($producto->descripcion) > 60) ? substr($producto->descripcion, 0,59) : $producto->descripcion;
    
    ?>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <?php if($producto->foto!="" && file_exists (Yii::$app->basePath.'/web/imagenes/thumbnail/'.$producto->foto)){?>		                        
                        <img src="<?php echo Yii::getAlias('@web')."/imagenes/thumbnail/".$producto->foto."";?>" alt="..." class="img-thumbnail img-responsive" style="height:150px;width: 100%;">                      
                    <?php }else{?>                
                        <img src="imagenes/foto-no-disponible.jpg" alt="..." class="img-thumbnail img-responsivee"  style="height:150px; width: 100%;">                     
                    <?php  }?>                                        
                    <div class="text-center">                                                
                        <strong><?php echo AppModel::sanitizarCadena($producto->inventario);?></strong>
                        <p>
                            <?php echo AppModel::sanitizarCadena($descripcion_corta_producto);?>
                        </p>
                        <a href="<?php echo Url::to(['/site/detalle-producto', 'producto_id' => $producto->inventario_id]);?>" > <?php echo Yii::t('app', 'Ver Detalles');?></a>                        
                    </div> 					  								
                </div>

<?php

	if($contador==1){
		$flag=false;
		?>
                </div>						
                </div>
        </div>			
		<?php
	}

	$contador++;
	if($contador==2)
	$contador=0;	

   // echo $producto->inventario_id;
}
?>

<?php if($contador==1){ ?>
                </div>						
            </div>
        </div>
<?php } ?>

<?php
//Mostrar los botones de navegación de paginas
echo LinkPager::widget([
    'pagination' => $paginas,
    'options'=>array('class'=>"pagination pagination-sm")

]);
?>

<ul id="menu_orden">
    <li><?php echo Yii::t('app', 'Ordenar:');?></li>
    <li><?php echo $sort->link('periodo_descripcion');?></li>
    <li><?php echo $sort->link('volumen_minimo');?></li>
    <li><?php echo $sort->link('volumen_maximo');?></li>
</ul>
<br>        

    <?php }
    ?>