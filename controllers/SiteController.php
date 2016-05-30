<?php
    namespace app\controllers;

    use Yii;
    use yii\web\Controller;
    use app\models\AppModel;
    use app\models\Cesta;
    use app\models\BuscadorProducto;
    use app\models\BuscadorSector;
    use app\models\BuscadorCanton;
    use app\models\BuscadorCandidato;
    use app\models\Candidato;
    use app\models\Postulacion;
    use app\models\CandidatoPostulacion;
    use app\models\PostulacionProducto;
    use app\models\FormularioCandidatoAcceso;
	use app\modules\chat\models\Operador;


    class SiteController extends Controller {

        public $layout = 'main';       


        /**
         *  Muestra la pantalla principal del sitio,
         *  En esta pantalla se muestran los productos aleatoriamente	 
         **/
        public function actionIndex(){	
            return $this->render('index', [

            ]);               
        }

        /**
         * Obtiene y muestra los productos pertenecientes a un Sector
         * @param integer $sector_industrial_id
         * @return mixed
         */   
        public function actionMostrarProductosPorSector($sector_industrial_id=0){
            $objBuscadorSector=new BuscadorSector();
            $objSector=$objBuscadorSector->obtenerSectorActivoConProductosPorId($sector_industrial_id);
            if($objSector==null){
                 Yii::$app->session->setFlash ('warning',Yii::t('app', 'El sector seleccionado es incorrecto') );
                 return $this->redirect(['/site/index']);     
            }
            if(isset($_SESSION['sector_industrial_id'])){
                $_SESSION['sector_industrial_id']=$sector_industrial_id;
            }

            if(isset($_SESSION['cadena_busqueda'])){
                $_SESSION['cadena_busqueda']="";
            }         
            $objBuscadorProducto=new BuscadorProducto();
            $respuesta=$objBuscadorProducto->obtenerProductosPorSector($sector_industrial_id);
            $respuesta['objSector']=$objSector;
            return $this->render('mostrar_productos_por_sector',$respuesta);           
        }


        /**
         * Obtiene y muestra los productos filtrados atraves del formulario 
         * @return mixed
         */       
        public function actionMostrarProductosPorFiltro(){
            if (Yii::$app->request->isPost) {
                $_SESSION['sector_industrial_id']= Yii::$app->request->post('sector_industrial_id')!="" ? Yii::$app->request->post('sector_industrial_id') : 0;            
                $_SESSION['cadena_busqueda']= Yii::$app->request->post('cadena_busqueda')!="" ? Yii::$app->request->post('cadena_busqueda') : "";                                    
            }         
            $sector_industrial_id=$_SESSION['sector_industrial_id'];
            if($sector_industrial_id!=0){
                $objBuscadorSector=new BuscadorSector();
                $objSector=$objBuscadorSector->obtenerSectorActivoConProductosPorId($sector_industrial_id);
                if($objSector==null){
                     Yii::$app->session->setFlash ('warning',Yii::t('app', 'El sector seleccionado es incorrecto') );
                     return $this->redirect(['/site/index']);     
                }
            }

            $objBuscadorProducto=new BuscadorProducto();
            $respuesta=$objBuscadorProducto->obtenerProductosPorFiltro($sector_industrial_id);
             if($sector_industrial_id!=0){
                $respuesta['objSector']=$objSector;
             }
            return $this->render('mostrar_productos_por_filtro',$respuesta);                  
        }


        /**
         * Obtiene y muestra el detalle de un producto en especifico
         * @param integer $producto_id
         * @return mixed
         */           
        public function actionDetalleProducto($producto_id=0){
            $objBuscadorProducto=new BuscadorProducto();
            $objProducto=$objBuscadorProducto->obtenerProductoPorId($producto_id);
            if($objProducto==null){
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'El producto no existe.') );
                return $this->redirect(['/site/index']);             
            }
            return $this->render('detalle_producto', [
                'objProducto'=>$objProducto
            ]);           
        }    

        /**
         * Muestra la informaci�n contenida en la cesta de productos prospectos a postularse
         * La informaci�n es obtenida de la session
         * @return mixed
         */               
        public function actionMostrarCesta(){
            return $this->render('mostrar_cesta',[
            ]);                 
        }     

        /**
         * Function que permite agregar un producto a la cesta
         * @param integer $producto_id Este parametro corresponde al identificador del producto
         * @return mixed
         */                   
        public function actionAgregarProducto($producto_id=0){
            $objBuscadorProducto=new BuscadorProducto();
            $objProducto=$objBuscadorProducto->obtenerProductoPorId($producto_id);
            if($objProducto==null){
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'El producto no existe en la base de datos.') );
                return $this->redirect(['/site/index']);             
            }

            if(Cesta::agregarProducto($objProducto)){
                Yii::$app->session->setFlash ('success',Yii::t('app', 'El producto fue agregado exitosamente.') );            
                return $this->redirect(['/site/mostrar-cesta']);      
            }else{            
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'El producto ya se encuentra en la cesta.'));
                return $this->redirect(['/site/index']);      
            }        
        } 

        /**
         * Function que permite remover un producto de la cesta
         * @param integer $producto_id Este parametro corresponde al identificador del producto
         * @return mixed
         */                       
        public function actionRemoverProducto($producto_id=0){        
            if(Cesta::removerProducto($producto_id)){
                Yii::$app->session->setFlash ('success',Yii::t('app', 'El producto fue removido exitosamente.') );                        
            }else{            
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'El producto no pude ser removido de la cesta.'));            
            } 
            return $this->redirect(['/site/mostrar-cesta']);  
        }     


        /**
         * Funcion que muestra un el formulario de postulaci�n	 
         * @return mixed
         */                       	 
        public function actionFormularioPostulacion(){
            //Validamos si existe la session del usuario
            if(isset($_SESSION['ece_postulator'])){
                return $this->redirect(['/site/confirmar-postulacion']);  
            }  

            //Validamos que en la cesta exista al menos 1 producto
            if(Cesta::obtenerTotalProductos()<=0){
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'Es necesario que la cesta tenga al menos 1 producto.'));            
                return $this->redirect(['/site/mostrar-cesta']);  
            }           

            $objCandidato = new Candidato();

            if($objCandidato->load(Yii::$app->request->post())) {				
                if($objCandidato->validate()) {

                    $objCandidato->estado="ACTIVO";  
                    $objCandidato->contrasena=AppModel::encriptarCadena($objCandidato->contrasena);  

                    //Guardar el candidato
                    if($objCandidato->save(false)) {
                        $objCandidato->ruc=trim($objCandidato->ruc);
                        $objCandidato->correo_electronico=trim($objCandidato->correo_electronico);  

                        $objPostulacion=new Postulacion();
                        $objPostulacion->total=Cesta::obtenerTotalProductos();
                        $objPostulacion->ip_remota=Yii::$app->request->userIP;

                        //Guardamos la informacion de la postulacion
                        if($objPostulacion->save(false)){//Guardamos la informacion de la postulacion
                            //Guardammos la relacion del candidato y la postulacion
                            $objCandidatoPostulacion=new CandidatoPostulacion();
                            $objCandidatoPostulacion->candidato_id=$objCandidato->candidato_id;
                            $objCandidatoPostulacion->postulacion_id=$objPostulacion->postulacion_id;
                            if($objCandidatoPostulacion->save(false)){

                                //Guardamos los productos de la postulacion                            
                                foreach(Cesta::obtenerProductos() as $producto){                            
                                    $objPostulacionProducto=new PostulacionProducto();                        
                                    $objPostulacionProducto->postulacion_id=$objPostulacion->postulacion_id;
                                    $objPostulacionProducto->inventario_id=$producto['inventario_id'];

                                    $objPostulacionProducto->save(false);
                                }
                            }
                        }                                        

                        //Vaciamos los productos de la cesta
                        Cesta::vaciarCesta();
                        Yii::$app->session->setFlash ('success',Yii::t('app', 'Su postulación ha sido completada exitosamente,, En breve le enviaremos un correo electrónico de confirmación.') );
                            return  $this->redirect(['/site/postulacion-completada']); 
                    }else{
                         $objCandidato->contrasena="";  
                         $objCandidato->confirmacion_contrasena="";  
                    }
                }else{
                    Yii::$app->session->setFlash ('danger',Yii::t('app', 'Por favor, revise el formulario') );
                }
            }


            return $this->render('formulario_postulacion',[
                'objCandidato'=>$objCandidato
            ]);
        } 

        /**
         * Funcion que muestra un el formulario para el inicio de session del postulante
         * @return mixed
         */                       	     
        public function actionIniciarSession(){
            $objFormularioCandidatoAcceso = new FormularioCandidatoAcceso();
             if ($objFormularioCandidatoAcceso->load(Yii::$app->request->post()) && $objFormularioCandidatoAcceso->login()) {
                Yii::$app->session->setFlash ('success',Yii::t('app', 'Acceso correcto.'));
                return  $this->redirect(['/site/confirmar-postulacion']);           
            }elseif( $objFormularioCandidatoAcceso->errors){            
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Las credenciales de acceso son incorrectas, intente de nuevo.'));            
            }

            return $this->render('iniciar_session',[
                'objFormularioCandidatoAcceso'=>$objFormularioCandidatoAcceso
            ]);               
        }   

        /**
         * Metodo que elimina la session de un candidato
         * @return mixed
         */                       	     
        public function actionBorrarSession(){
            unset($_SESSION['ece_postulator']);		
            return $this->redirect(['/site/formulario-postulacion']);                
        }         

        /**
         * Funcion que muestra una pantalla de confirmaci�n de la postulaci�n,
         * esta pantalla solo se muestra con session iniciada es decir en una segunda postulacion.
         * @return mixed
         */                       	         
        public function actionConfirmarPostulacion(){                        
            if(!isset($_SESSION['ece_postulator'])){
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Favor de iniciar session en el siguiente formulario.'));            
                return  $this->redirect(['/site/iniciar-session']);           
            }

            //Validamos que en la cesta exista al menos 1 producto
            if(Cesta::obtenerTotalProductos()<=0){
                Yii::$app->session->setFlash ('warning',Yii::t('app', 'Es necesario que la cesta tenga al menos 1 producto.'));            
                return $this->redirect(['/site/mostrar-cesta']);  
            }           

            $objBuscadorCandidato=new BuscadorCandidato();
            $objCandidato=$objBuscadorCandidato->obtenerCandidatoPorId($_SESSION['ece_postulator']['candidato_id']);               

            if(Yii::$app->request->post()) {            
                $objPostulacion=new Postulacion();
                $objPostulacion->total=Cesta::obtenerTotalProductos();
                $objPostulacion->ip_remota=Yii::$app->request->userIP;

                //Guardamos la informacion de la postulacion
                if($objPostulacion->save(false)){//Guardamos la informacion de la postulacion
                    //Guardammos la relacion del candidato y la postulacion
                    $objCandidatoPostulacion=new CandidatoPostulacion();
                    $objCandidatoPostulacion->candidato_id=$_SESSION['ece_postulator']['candidato_id'];
                    $objCandidatoPostulacion->postulacion_id=$objPostulacion->postulacion_id;
                    if($objCandidatoPostulacion->save(false)){
                        //Guardamos los productos de la postulacion                            
                        foreach(Cesta::obtenerProductos() as $producto){                            
                            $objPostulacionProducto=new PostulacionProducto();                        
                            $objPostulacionProducto->postulacion_id=$objPostulacion->postulacion_id;
                            $objPostulacionProducto->inventario_id=$producto['inventario_id'];

                            $objPostulacionProducto->save(false);
                        }
                    }
                }                                        

                //Vaciamos los productos de la cesta
                Cesta::vaciarCesta();
                Yii::$app->session->setFlash ('success',Yii::t('app', 'Su postulación ha sido completada exitosamente, En breve le enviaremos un correo electrónico de confirmación.') );
                return  $this->redirect(['/site/postulacion-completada']);         
            }        

            return $this->render('confirmar_postulacion',[    
                'objCandidato'=>$objCandidato
            ]);                
        }

        public function actionObtenerCantonesPorProvincia($provincia_id=0){   
            Yii::$app->response->format ="json";
            return BuscadorCanton::obtenerCantonesPorProvincia($provincia_id);        
        }

        /**
         * Accion que muestra la pantalla de que la postulación fue registrada con exito.
         */
        public function actionPostulacionCompletada(){
                Yii::$app->session->setFlash ('success',Yii::t('app', 'Su postulación ha sido completada exitosamente, En breve le enviaremos un correo electrónico de confirmación.') );

                return $this->render('postulacion_completada',[                
            ]);           
        }

        /**
         * Pagina para presentrar las preguntas precuentes
         */
        public function actionFaq(){

            return $this->render('faq',[]);     
        }

  
		public function actionChat(){
			Yii::$app->response->format = "json";
			$data=array("disponibles"=>false);
			$objOperador=Operador::find()->all();
			if($objOperador){
			$data['disponibles']=true;
			}
			
			return $data;		
		}
		
		
		public function actionOperadorNoDisponible(){
                Yii::$app->session->setFlash ('danger',Yii::t('app', 'Por el momento no '));            
                return  $this->redirect(['/site/iniciar-session']);  		
		}

}