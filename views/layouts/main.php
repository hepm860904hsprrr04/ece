<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\BuscadorSector;
use app\models\BuscadorProducto;
use app\models\FormularioFiltro;
use app\models\Cesta;
use app\models\AppModel;

//use app\models\;

    AppAsset::register($this);
    
    $objCesta=new Cesta();
    

    $objBuscadorSector = new BuscadorSector();
    $sectores = $objBuscadorSector->obtenerSectoresActivosConProductos();
    
    $objBuscadorProducto=new BuscadorProducto();
    $objProductoRequerido=$objBuscadorProducto->obtenerProductoRequerido();    
    
    $objFormularioFiltro = new FormularioFiltro();
    
    //Verifica si existe un sector seleccionado para seleccionarlo en el formulario de filtro
    if (isset($_SESSION['sector_industrial_id'])) {
        $objFormularioFiltro->sector_industrial_id = $_SESSION['sector_industrial_id'];
    }
    
    //Verifica si existe una cadena de busqueda para mostrarla en el formulario de busqueda
    if (isset($_SESSION['cadena_busqueda'])) {
        $objFormularioFiltro->cadena_busqueda = $_SESSION['cadena_busqueda'];
    }    
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        
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
        
        .panel-body-right {
            padding: 5px;
            text-align: center;
        }        
    </style>

    </head>

    <body>
        <?php $this->beginBody() ?>
        <div class="container" style="max-width: 1000px;">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?php echo Url::to(['/']); ?>">
                        <img data-src="holder.js/140x140" class="img-rounded" alt="140x140"  src="imagenes/site/ecuador-compra-ecuador.png" data-holder-rendered="true">			
                    </a>				
                </div>
                <div class="col-md-7">	
                    <?php $form = ActiveForm::begin(['action' => ['/site/mostrar-productos-por-filtro']]); ?>							
                    <form method="post" action="" id="form_search">
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group input-group-sm">		
                                    <?php echo $form->field($objFormularioFiltro, 'sector_industrial_id')->dropdownList($sectores, ['prompt' => Yii::t('app', 'Todos los Sectores'), 'class' => 'form-control input-sm', 'name' => 'sector_industrial_id'])->label(false); ?>
                                </div>						
                            </div>		
                        </div>	

                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Ingresa el servicio o producto que estas buscando..."  name="cadena_busqueda" value="<?php echo $objFormularioFiltro->cadena_busqueda; ?>">
                            <span class="input-group-btn"> 											
                                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-search"></span> Buscar</button> </span>
                        </div>

                    </form>	
                    <?php ActiveForm::end(); ?>				
                </div>		
                <div class="col-md-2">
                    <a href="http://www.industrias.gob.ec/">				
                        <img src="imagenes/site/ministro-de-industrias-productivas.png" class="img-rounded">			
                    </a>
                </div>			
            </div>

            
            <div class="content" style="margin:15px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="<?php echo Url::to(['/site/faq']); ?>" class="btn btn-link">Preguntas Frecuentes</a>
                                <a href="<?php echo Yii::getAlias('@web') . "/docs/pasos.pdf"; ?>" class="btn btn-link" target="_blank">Pasos a seguir</a>
                                <a href="<?php echo Yii::getAlias('@web') . "/docs/bases_encadena.pdf"; ?>" class="btn btn-link" target="_blank">Términos y condiciones</a>
                                <a href="mailto:contactanos@encadenaenlinea.com" class="btn btn-link"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contáctanos</a>
                            </div>

                        </div>

                    </div>			
                </div>	
            </div>
            
            <?php 
                $sector_industrial_seleccionado_id=0;
                if(Yii::$app->request->get('sector_industrial_id')){
                    $sector_industrial_seleccionado_id=Yii::$app->request->get('sector_industrial_id');
                }elseif(isset($_SESSION['sector_industrial_id'])){
                    $sector_industrial_seleccionado_id=$_SESSION['sector_industrial_id'];
                }
            
            ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-info"> 
                        <div class="panel-heading panel-right text-center">
                          <?php echo Yii::t('app', 'Sectores en los que puedes emprender'); ?> </small>
                        </div>
                        <div class="list-group" > 
                            <?php foreach ($sectores as $key => $val) { ?>
                                <a href="<?php echo Url::to(['/site/mostrar-productos-por-sector', 'sector_industrial_id' => $key]); ?>" class="list-group-item <?php echo ($sector_industrial_seleccionado_id == $key) ? 'active' : ''; ?>" style="margin-bottom: 0;    border: 0 none;"><small> <?php  echo $val;?></small></a>
                            <?php } ?>	
                        </div>
                    </div>                  							
                </div>
                <div class="col-md-7">		
                    <?php
                    echo Breadcrumbs::widget([
                        'homeLink' => array('label' => 'Home', 'url' => '?'),
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    
                    <!-- breadcrumbs -->  
                     
                    <?php
                    //Muestra los mensajes de alerta enviados desde el controller a traves del metodo setFlash del objeto request
                    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                        Yii::$app->session->removeFlash($key);
                    }
                    ?>

                    <?php 
                        //Escribe el el resultado de las vistas en el layout
                        echo $content; 
                    ?>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-info"> 
                        <div class="panel-heading panel-right text-center">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><small> <?php echo Yii::t('app', 'Cesta'); ?> </small>
                        </div>
                        <div class="panel-body panel-body-right"> 
                            <a href="<?php echo Url::to(['/site/mostrar-cesta']); ?>">
                                <small>( <?php echo $objCesta->obtenerTotalProductos(); ?> ) <?php echo Yii::t('app', 'Productos'); ?> </small>
                            </a>
                        </div> 
                    </div>	

                <?php  if ($objProductoRequerido!=null) { ?>
                <?php
                    $descripcion_producto_requerido=ucfirst(strtolower(html_entity_decode(htmlentities($objProductoRequerido->inventario))));
                    $descripcion_producto_requerido=strtr($descripcion_producto_requerido,  "ÁÉÍÓÚ","áéíóú");
                ?>
                        <div class="panel panel-info"> 
                            <div class="panel-heading panel-right text-center"><small><?php echo Yii::t('app', 'Producto Requerido');?> </small></div>
                            <div class="panel-body panel-body-right"> 
                                <?php if ($objProductoRequerido->foto != "" && file_exists(Yii::$app->basePath . '/web/imagenes/thumbnail/' . $objProductoRequerido->foto)) { ?>
                                     <img src="<?php echo Yii::getAlias('@web')."/imagenes/thumbnail/".$objProductoRequerido->foto."";?>" alt="..." class="img-thumbnail">
                                    <?php } else {
                                    ?>
                                        <img src="imagenes/foto-no-disponible.jpg" alt="..." class="img-thumbnail img-responsive"> 
                                     <?php } ?>
                                   
                                <a href="<?php echo Url::to(['/site/detalle-producto', 'producto_id' => $objProductoRequerido->inventario_id]); ?>">
                                    <center>
                                         <?php echo $descripcion_producto_requerido; ?>
                                    </center>
                                </a> 
                            </div> 
                        </div>	
                <?php } ?>

                    <div class="panel panel-info "> 
                        <div class="panel-heading panel-right text-center"><small> <?php echo Yii::t('app', 'Contador de visitas');?> </small> </div>
                        <div class="panel-body panel-body-right">
                            <!-- Start of StatCounter Code for Dreamweaver -->
                            <script type="text/javascript">
                                var sc_project = 10090366;
                                var sc_invisible = 0;
                                var sc_security = "da4047ba";
                                var scJsHost = (("https:" == document.location.protocol) ?
                                        "https://secure." : "http://www.");
                                document.write("<sc" + "ript type='text/javascript' src='" + scJsHost +
                                        "statcounter.com/counter/counter.js'></" + "script>");
                            </script>
                            <noscript><div class="statcounter"><a title="shopify visitor statistics"
                                                                  href="http://statcounter.com/shopify/" target="_blank"><img
                                        class="statcounter" src="http://c.statcounter.com/10090366/0/da4047ba/0/"
                                        alt="shopify visitor statistics"></a></div></noscript>
                            <!-- End of StatCounter Code for Dreamweaver -->
                        </div> 
                    </div>
                    						
                            <a style="display:none;" id="link_no_disponibles" href="#"><img title="Ecuador compra ecuador, operadores no disponibles" alt="Ecuador Ama la Vida" src="imagenes/no_disponibles.gif" width="100%"> </a>                            
							<a target="_blank"  style="display:none;" id="link_disponibles" href="<?php echo Url::to(['/chat/cliente/iniciar']); ?>"><img title="Ecuador compra ecuador, operadores disponibles" alt="Ecuador Ama la Vida" src="imagenes/disponibles.gif" width="100%" > </a>                            							
          
                    
                </div>

            </div>
            <div class="row" style="background: url(http://www.encadenaenlinea.com/img/colores.png) bottom no-repeat; padding-bottom:20px;">
           
                <div class="col-xs-4">		
                    <img title="Presidencia de la República" alt="Presidencia de la República" src="imagenes/logo_presidencia.png">
                </div>        
                <div class="col-xs-4">
                    <div style="color:#333; text-align:center;">Yánez Pinzón N26-12, entre Av. Colón y La Niña Código Postal: 170516 / Quito - Ecuador<br>
                                            Teléfono: 593-2 394 8760<br>
                    </div>	
                </div>		
                <div class="col-xs-4" align="right">
                    <img title="Ecuador Ama la Vida" alt="Ecuador Ama la Vida" src="imagenes/ecuadoramalavida_logo.png" width="138" height="37">	
                </div>
            </div>                
                  
        </div>
<?php $this->endBody() ?>
<script type="text/javascript">
$(document).ready(function(){	
	        
    setInterval(function(){

       verificarOperaoresDisponibles()
        
   }, 5000);
   
   verificarOperaoresDisponibles();
    function verificarOperaoresDisponibles(){        
        $.ajax({
            url: "?r=site/chat",
            method:'get',
			dataType:'json',            
        }).done(function(response) {
			console.log(response);
			if(response.disponibles){
				$("a[id=link_no_disponibles]").hide();					
				$("a[id=link_disponibles]").show();		
				
				
			}else{				
				$("a[id=link_disponibles]").hide();					
				$("a[id=link_no_disponibles]").show();				
			}
        });  
        
      
    }     
   
});   
</script>
    </body>
</html>
<?php $this->endPage() ?>

