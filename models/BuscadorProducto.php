<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;
use yii\data\Pagination;
use yii\data\Sort;
use app\models\BuscadorSector;

/**
 * BuscadorProducto represents the model behind the search form about `app\models\Producto`.
 */
class BuscadorProducto extends Producto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventario_id', 'empresa_id', 'unidad_id', 'periodo_id', 'partida_id', 'ubicacion_necesidad_id', 'sector_industrial_id', 'aliado_id', 'creado_por', 'modificado_por', 'asignado_a', 'total_postulacion'], 'integer'],
            [['inventario', 'descripcion', 'codigo', 'foto', 'anexo', 'observaciones', 'fecha_creacion', 'fecha_modificacion', 'fecha_asignacion','nombre_sector'], 'safe'],
            [['volumen_minimo', 'volumen_maximo', 'precio_referencia_min', 'precio_referencia_maximo'], 'number'],
            [['publicado'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
	
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_productos';
    }	

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['inventario_id' => 'DESC']]
        ]);

        $this->load($params);
        if($_SESSION['ece_admin']['esAdmin']==false){
            if(isset($_SESSION['ece_admin']['sectores_asignados']) && count($_SESSION['ece_admin']['sectores_asignados'])>0){
                $query->where('sector_industrial_id in ('.implode(',',$_SESSION['ece_admin']['sectores_asignados']).')');
            }else{
                //Si no existe ningun sector asignado al usuario, no se visualiza
                $query->where('0=1');
            }
        }
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'inventario_id' => $this->inventario_id,
            'empresa_id' => $this->empresa_id,
            'volumen_minimo' => $this->volumen_minimo,
            'volumen_maximo' => $this->volumen_maximo,
            'unidad_id' => $this->unidad_id,
            'periodo_id' => $this->periodo_id,
            'partida_id' => $this->partida_id,
            'ubicacion_necesidad_id' => $this->ubicacion_necesidad_id,
            'precio_referencia_min' => $this->precio_referencia_min,
            'precio_referencia_maximo' => $this->precio_referencia_maximo,
            'publicado' => $this->publicado,
            'sector_industrial_id' => $this->sector_industrial_id,
            'aliado_id' => $this->aliado_id,
            'creado_por' => $this->creado_por,
            'fecha_creacion' => $this->fecha_creacion,
            'modificado_por' => $this->modificado_por,
            'fecha_modificacion' => $this->fecha_modificacion,
            'asignado_a' => $this->asignado_a,
            'fecha_asignacion' => $this->fecha_asignacion,
            'total_postulacion' => $this->total_postulacion,
        ]);

        $query->andFilterWhere(['ilike', 'inventario', $this->inventario])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'foto', $this->foto])
            ->andFilterWhere(['ilike', 'anexo', $this->anexo])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
	
    /**
     *  Metodo que obtiene una instancia de Producto buscandolo por su Id
     * @param type $producto_id
     * @return type
     */
    public static function obtenerProductoPorId($producto_id=0){  
        $objProducto= self::find()
                        ->where(['inventario_id' => $producto_id])
                        ->one();
        if($objProducto!=null){
            $objProducto->inventario=AppModel::sanitizarCadena($objProducto->inventario);
            $objProducto->descripcion=AppModel::sanitizarCadena($objProducto->descripcion);            
            $objProducto->observaciones=AppModel::sanitizarCadena($objProducto->observaciones);
            $objProducto->nombre_sector=AppModel::sanitizarCadena($objProducto->nombre_sector);            
            return $objProducto;
        }
        return  null;        
    }	
    
    /**
     * 
     * @return type Array Regresa un Array con los productos seleccionados agrupados por sector
     */
    public function obtenerProductosAleatorios(){			
        $cadena_sql="SELECT * FROM ec_mipro_ece.vw_productos_aleatorios ";						
        $products=self::findBySql($cadena_sql)->all();                                    			 
        if($products!=null && count($products)>0){
            $productos_aleatorios=array();
            foreach ($products as $producto) {  
                $producto->inventario=AppModel::sanitizarCadena($producto->inventario);
                $producto->descripcion=AppModel::sanitizarCadena($producto->descripcion);            
                $producto->observaciones=AppModel::sanitizarCadena($producto->observaciones);
                $producto->nombre_sector=AppModel::sanitizarCadena($producto->nombre_sector);  
            
                $productos_aleatorios[$producto->sector_industrial_id]['sector_industrial_id']=$producto->sector_industrial_id;
                $productos_aleatorios[$producto->sector_industrial_id]['nombre_sector']=AppModel::sanitizarCadena($producto->nombre_sector);                
                $productos_aleatorios[$producto->sector_industrial_id]['productos'][]=$producto;
            }
            return $productos_aleatorios;
        }        
        return array();
    }  
    
    
    /**
     * Metodo que obtiene un producto aleatorio 
     * @return Instancia de Producto o null si no se obtuvo ningun producto
     */
    public function obtenerProductoRequerido(){			
        $cadena_sql="SELECT * FROM ec_mipro_ece.vw_productos_aleatorios limit 1";
        return self::findBySql($cadena_sql)->one();                                    			 
    } 
    
    /**
     * Metodo que obtiene 4 productos sugeridos
     * @return Array , Regresa un array de productos 
     */
    public function obtenerProductosSugeridos(){			
        $cadena_sql="SELECT * FROM ec_mipro_ece.vw_obtener_productos_sugeridos;";
        return self::findBySql($cadena_sql)->all();                                    			 
    }     
    
    /**
     * Obtiene productos por sector
     *
     * @param integer $sector_id
     *
     * @return Array
     */
    public function obtenerProductosPorSector($sector_industrial_id=0){
        $respuesta=array();
        unset($_SESSION['search_string']);        
        $request = Yii::$app->request;
        $respuesta['sector_industrial_id']=$request->get('sector_industrial_id',0);         
        $respuesta['campo_orden']=$request->get('campo_orden',"inventario");
        $respuesta['direccion']=$request->get('direccion',"ASC");
        $respuesta['pagina']=$request->get('pagina',1);

        $sort = new Sort([
            'attributes' => [
                'periodo_descripcion' => [
                    'asc' => ['periodo_descripcion' => SORT_ASC],
                    'desc' => ['periodo_descripcion' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' =>'Periodo de Consumo',
                    ],
                'volumen_minimo' => [
                    'asc' => ['volumen_minimo' => SORT_ASC],
                    'desc' => ['volumen_minimo' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' =>'Volumen minimo',
                    ],
                'volumen_maximo' => [
                    'asc' => ['volumen_maximo' => SORT_ASC],
                    'desc' => ['volumen_maximo' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' =>'Volumen máximo',
                    ]                                          
            ],
        ]);

        $respuesta['sort']=$sort;

        $query = self::find()
        ->where('publicado=true and total_postulacion<=10 and sector_industrial_id='.$sector_industrial_id);


        $countQuery = self::find()
        ->where('publicado=true and total_postulacion<=10 and sector_industrial_id='.$sector_industrial_id);
        $paginas = new Pagination(['totalCount' => $countQuery->count()]);
        $productos = $query->offset($paginas->offset)
        ->orderBy($sort->orders)     
            ->limit($paginas->limit)            
            ->all();

        $respuesta['direccion']=($respuesta['direccion']=="ASC") ? "DESC" : "ASC";

        $respuesta['productos']=$productos;
        $respuesta['paginas']=$paginas;
        return  $respuesta;
    }    
    
   
    

    /**
     * Obtiene productos filtrador
     *     
     *
     * @return Array
     */
    public function obtenerProductosPorFiltro(){
        $respuesta=array();            
        $request = Yii::$app->request;
        if($request->isPost){
            $_SESSION['sector_industrial_id']= Yii::$app->request->post('sector_industrial_id')!="" ? Yii::$app->request->post('sector_industrial_id') : 0;            
            $_SESSION['cadena_busqueda']= Yii::$app->request->post('cadena_busqueda')!="" ? Yii::$app->request->post('cadena_busqueda') : "";
        } 
        
        $respuesta['sector_industrial_id']=$_SESSION['sector_industrial_id'];         
        $respuesta['campo_orden']=$request->get('campo_orden',"inventario");
        $respuesta['direccion']=$request->get('direccion',"ASC");
        $respuesta['pagina']=$request->get('pagina',1);

        $sort = new Sort([
            'attributes' => [
                'periodo_descripcion' => [
                    'asc' => ['periodo_descripcion' => SORT_ASC],
                    'desc' => ['periodo_descripcion' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' =>'Periodo de Consumo',
                    ],
                'volumen_minimo' => [
                    'asc' => ['volumen_minimo' => SORT_ASC],
                    'desc' => ['volumen_minimo' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' =>'Volumen minimo',
                    ],
                'volumen_maximo' => [
                    'asc' => ['volumen_maximo' => SORT_ASC],
                    'desc' => ['volumen_maximo' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' =>'Volumen máximo',
                    ]                                          
            ],
        ]);

        $respuesta['sort']=$sort;        
        $objBuscadorSector=new BuscadorSector();        
        
        $condicion='publicado=true and total_postulacion<=10 ';
        if(isset($_SESSION['sector_industrial_id']) && $_SESSION['sector_industrial_id']!=0 && $objBuscadorSector->obtenerSectoresActivosConProductos($_SESSION['sector_industrial_id'])!=NULL){
            $condicion.=" and sector_industrial_id=".$_SESSION['sector_industrial_id'];
        }
        
        $query = self::find()
        ->where($condicion);
        
        if(isset($_SESSION['cadena_busqueda']) && $_SESSION['cadena_busqueda']!=""){
            $cadena_busqueda=$_SESSION['cadena_busqueda'];
            $query->andFilterWhere(['or', 
                ['ilike', 'unaccent(inventario)', $cadena_busqueda],
                ['ilike', 'unaccent(descripcion)', $cadena_busqueda],
                ['ilike', 'unaccent(codigo)',$cadena_busqueda],
                ['ilike', 'unaccent(unidad_nombre)', $cadena_busqueda],
                //['ilike', 'unaccent(nombre_sector)', $cadena_busqueda],
                ['ilike', 'unaccent(partida_descripcion)', $cadena_busqueda]
                ]);                
        }
        
        $countQuery = self::find()
        ->where($condicion);
        if(isset($_SESSION['cadena_busqueda']) && $_SESSION['cadena_busqueda']!=""){
            $cadena_busqueda=$_SESSION['cadena_busqueda'];
            $countQuery->andFilterWhere(['or', 
                ['ilike', 'unaccent(inventario)', $cadena_busqueda],
                ['ilike', 'unaccent(descripcion)', $cadena_busqueda],
                ['ilike', 'unaccent(codigo)',$cadena_busqueda],
                ['ilike', 'unaccent(unidad_nombre)', $cadena_busqueda],
                //['ilike', 'unaccent(nombre_sector)', $cadena_busqueda],
                ['ilike', 'unaccent(partida_descripcion)', $cadena_busqueda]
                ]);                
        }   
        
        $paginas = new Pagination(['totalCount' => $countQuery->count()]);
        $productos = $query->offset($paginas->offset)
        ->orderBy($sort->orders)     
            ->limit($paginas->limit)            
            ->all();

        $respuesta['direccion']=($respuesta['direccion']=="ASC") ? "DESC" : "ASC";

        $respuesta['productos']=$productos;
        $respuesta['paginas']=$paginas;
        return  $respuesta;
    } 
    
    
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function obtenerProductosPorEmpresa($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['inventario_id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('empresa_id='.$_SESSION['ece_empresa']['empresa_id']);
            return $dataProvider;
        }
        $query->where('empresa_id='.$_SESSION['ece_empresa']['empresa_id']);  
        
        $query->andFilterWhere([
            'inventario_id' => $this->inventario_id,            
            'volumen_minimo' => $this->volumen_minimo,
            'volumen_maximo' => $this->volumen_maximo,
            'unidad_id' => $this->unidad_id,
            'periodo_id' => $this->periodo_id,
            'partida_id' => $this->partida_id,
            'ubicacion_necesidad_id' => $this->ubicacion_necesidad_id,
            'precio_referencia_min' => $this->precio_referencia_min,
            'precio_referencia_maximo' => $this->precio_referencia_maximo,
            'publicado' => $this->publicado,
            'sector_industrial_id' => $this->sector_industrial_id,
            'aliado_id' => $this->aliado_id,
            'creado_por' => $this->creado_por,
            'fecha_creacion' => $this->fecha_creacion,
            'modificado_por' => $this->modificado_por,
            'fecha_modificacion' => $this->fecha_modificacion,
            'asignado_a' => $this->asignado_a,
            'fecha_asignacion' => $this->fecha_asignacion,
            'total_postulacion' => $this->total_postulacion,
        ]);

        $query->andFilterWhere(['ilike', 'inventario', $this->inventario])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'foto', $this->foto])
            ->andFilterWhere(['ilike', 'anexo', $this->anexo])
            ->andFilterWhere(['ilike', 'nombre_sector', $this->nombre_sector])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
    
    
    
    public static function obtenerProductoPorEmpresaIdProductoId($producto_id=0){
        return  self::find()
                ->where(['empresa_id'=>$_SESSION['ece_empresa']['empresa_id'],'inventario_id'=>$producto_id])           
                ->one();        
    }
}
