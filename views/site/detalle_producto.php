<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\AppModel;


$this->title = Yii::t('app', 'Detalle de Producto');

$this->params['breadcrumbs'][] = ['label' =>$objProducto->nombre_sector, 'url' => ['/site/mostrar-productos-por-sector','sector_industrial_id'=>$objProducto->sector_industrial_id]];
$this->params['breadcrumbs'][] =$objProducto->inventario;
?>

<div class="panel panel-primary">
    <div class="panel-heading"><?php echo $objProducto->inventario;?></div>
    <div class="panel-body">
        <?php if($objProducto->foto!="" && file_exists (Yii::$app->basePath.'/web/imagenes/productos/'.$objProducto->foto)){?>		                        
            <img src="<?php echo Yii::getAlias('@web')."/imagenes/productos/".$objProducto->foto."";?>" alt="..." class="img-thumbnail img-responsive" style="width: 100%; height: 250px;">                    
        <?php }else{?>
            <img src="imagenes/foto-no-disponible.jpg" alt="..." class="img-thumbnail img-responsive center-block" style="width: 100%; height: 250px;">     
        <?php
        }
        ?>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2"><?php echo Yii::t('app', 'Detalle del Producto');?></th>
                </tr>            
            </thead>
            <tbody>
                <tr>
                    <td><?php echo Yii::t('app', 'Código');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->codigo);?></td>
                </tr>                
                <tr>
                    <td><?php echo Yii::t('app', 'Producto');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->inventario);?></td>
                </tr>
                <tr>
                    <td><?php echo Yii::t('app', 'Descripción');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->descripcion);?></td>
                </tr>
                <tr>
                    <td><?php echo Yii::t('app', 'Unidad de Medida');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->unidad_nombre);?></td>
                </tr>
                <tr>
                    <td><?php echo Yii::t('app', 'Periodo Descripción');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->periodo_descripcion);?></td>
                </tr>                  
                <tr>
                    <td><?php echo Yii::t('app', 'Partida');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->partida_descripcion);?></td>
                </tr>                 
                <tr>
                    <td><?php echo Yii::t('app', 'Precio Referencia Minimo');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->precio_referencia_min);?></td>
                </tr>                  
                <tr>
                    <td><?php echo Yii::t('app', 'Precio Referencia Máximo');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->precio_referencia_maximo);?></td>
                </tr> 
                <tr>
                    <td><?php echo Yii::t('app', 'Volumen Minimo');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->volumen_minimo);?></td>
                </tr>                  
                <tr>
                    <td><?php echo Yii::t('app', 'Volumen Máximo');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->volumen_maximo);?></td>
                </tr>                 
                <tr>
                    <td><?php echo Yii::t('app', 'Sector');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->nombre_sector);?></td>
                </tr>    
                <tr>
                    <td><?php echo Yii::t('app', 'Observaciones');?>:</td>
                    <td><?php echo AppModel::sanitizarCadena($objProducto->observaciones);?></td>
                </tr>                  
            </tbody>
        </table>       
    </div>
    <div class="panel-footer">
        <div class="btn-group btn-group-sm" role="group"> 
            <a href="#" id="cmdback" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <?php echo Yii::t('app', 'Atras');?></a>
        </div>

        <div class="btn-group btn-group-sm pull-right" role="group">             
            <a href="<?php echo  Url::to(['/site/agregar-producto', 'producto_id' => $objProducto->inventario_id]);?>" class="btn btn-success"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo Yii::t('app', 'Agregar Producto');?> </a>
        </div>          
    </div>    
</div>

<?php 
$productos_sugeridos=$objProducto->obtenerProductosSugeridos();

if($productos_sugeridos!=null){
?>
<div class="panel panel-info">
    <div class="panel-heading"><?php echo Yii::t('app', 'Productos sugeridos');?></div>
    <div class="panel-body text-center">
        <div class="row ">                        
            <?php foreach ($productos_sugeridos as $producto_sugerido) {
                
                ?>
                <div class="col-lg-3 col-sm-3 col-xs-3">      
                    <?php if($producto_sugerido->foto!="" && file_exists (Yii::$app->basePath.'/web/imagenes/thumbnail/'.$producto_sugerido->foto)){?>                                
                    <img src="<?php echo Yii::getAlias('@web')."/imagenes/thumbnail/".$producto_sugerido->foto."";?>" alt="..." class="img-thumbnail img-responsive" style="height: 100px;"> 
                    <?php }else{ ?>
                         <img src="imagenes/foto-no-disponible.jpg" alt="..." class="img-thumbnail img-responsive"  style="height: 100px;">                     
                    <?php } ?>

                    <div class="text-center">
                        <small><a href="<?php echo Url::to(['/site/detalle-producto', 'producto_id' => $producto_sugerido->inventario_id]);?>" > <?php echo AppModel::sanitizarCadena($producto_sugerido->inventario);?></a></small>
                    </div> 
                </div>            
            <?php }?>
        </div>
    </div>
</div>
<?php
}
?>
