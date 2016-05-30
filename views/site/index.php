<?php 
use yii\helpers\Url;
use app\models\BuscadorProducto;
use app\models\AppModel;
    
    $objBuscadorProducto=new BuscadorProducto();
    $productos_aleatorios=$objBuscadorProducto->obtenerProductosAleatorios();
?>
<style type="text/css">
.carousel{
    background: #2f4357;
    /*margin-top: 20px;*/
}
.carousel .item img{
    margin: 0 auto; /* Align slide image horizontally center */
}
.bs-example{
	margin-bottom:20px;
}

.panel-right{
    padding: 2px 2px;
}
</style>

<div class="bs-example">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>   
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo Yii::getAlias('@web')."/imagenes/001.jpg";?>" alt="First Slide">
            </div>
            <div class="item">
                <img src="<?php echo Yii::getAlias('@web')."/imagenes/002.jpg";?>" alt="Second Slide">
            </div>
            <div class="item">
                <img src="<?php echo Yii::getAlias('@web')."/imagenes/003.jpg";?>" alt="Third Slide">
            </div>
        </div>
        <!-- Carousel controls -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>


<?php 
foreach($productos_aleatorios as $sector){ 
?>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading"><?php echo AppModel::sanitizarCadena($sector['nombre_sector']);?></div>
        <div class="panel-body text-center">
            <div class="row ">
                <?php 
                    $conta=0;
                    foreach ($sector['productos'] as $producto) {
                ?>
                <div class="col-lg-3 col-sm-3 col-xs-3">	
                    
                    <?php if($producto->foto!="" && file_exists (Yii::$app->basePath.'/web/imagenes/thumbnail/'.$producto->foto)){?>		                        
                    <img src="<?php echo Yii::getAlias('@web')."/imagenes/thumbnail/".$producto->foto."";?>" alt="..." class="img-thumbnail img-responsive" height="100px;">                    
                    <?php }else{?>                
                        <img src="imagenes/foto-no-disponible.jpg" alt="..." class="img-thumbnail img-responsivee" height="100px;">                    
                    <?php  }?>                                        
                    <div class="text-center">
                        <small><a href="<?php echo Url::to(['/site/detalle-producto', 'producto_id' => $producto->inventario_id]);?>" > <?php echo AppModel::sanitizarCadena($producto->inventario);?></a></small>
                    </div>                    
                </div>
                
                    <?php 
                        $conta++;
                        }

                        while($conta!=4){
                    ?>
                    <div class="col-md-3">			

                    </div>			
                    <?php	
                            $conta++;
                            }
                    ?>

            </div>
        </div>
    </div>

<?php }?>


