<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\AppModel;
use app\models\Cesta;


$this->title = Yii::t('app', 'Mostrar Cesta');
$this->params['breadcrumbs'][] = $this->title;
$productos=Cesta::obtenerProductos();
?>

<div class="panel panel-primary">    
    <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> <?php echo Yii::t('app', 'Lista de productos');?></div>
    <table class="table table-striped">        
            <tbody>                    
                <?php                     
                //mostrar los productos de la cesta
                foreach($productos as  $producto){?>
                <tr>   
                    <td>
                        <a class="btn btn-link " href="<?php echo Url::to(['/site/detalle-producto', 'producto_id' => $producto['inventario_id'] ]);?>" >
                             <?php echo  $producto['codigo'];?>
                        </a>
                       
                    </td>
                    <td class="text-left">  
                        <?php echo $producto['inventario'];?>
                    </td> 						
                    <td>
                        <div class="btn-group btn-group-xs pull-right" role="group" aria-label="Extra-small button group">                                
                            <a class="btn btn-danger " href="<?php echo Url::to(['/site/remover-producto', 'producto_id' => $producto['inventario_id'] ]);?>" > <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>                            
                        </div>
                    </td>
                </tr> 
                <?php                        
                }
                ?>
            </tbody>
        <tfoot>
            <tr>
                <td class="text-muted" colspan="3"><?php echo Yii::t('app', 'Total de Productos') ?>: <?php echo Cesta::obtenerTotalProductos();?></td>                    
            </tr>
        </tfoot>
    </table>    

    <div class="panel-footer">        
        <div class="btn-group btn-group-sm" role="group"> 
            <a href="#" id="cmdback" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <?php echo Yii::t('app', 'Atras');?></a>
        </div>

        <div class="btn-group btn-group-sm pull-right" role="group">             
            <a href="<?php echo Url::to(['/site/formulario-postulacion' ]);?>" class="btn btn-success"><?php echo Yii::t('app', 'Siguiente');?> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> </a>            
        </div> 			
    </div>	
  
</div>