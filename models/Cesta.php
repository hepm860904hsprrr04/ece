<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Cesta extends Model
{    
    /**
     *  Metodo que devuelve la lista de productos en la cesta
     */
    public static function obtenerProductos(){              
        return isset($_SESSION['cesta']['productos']) ? $_SESSION['cesta']['productos'] : array();
    }
    
    /**
     *  Metodo que devuelve el total de productos en la cesta
     */
    public static function obtenerTotalProductos(){                
        return isset($_SESSION['cesta']['total_items']) ? $_SESSION['cesta']['total_items'] : 0;
    }    
    
    /**
     * Metodo que permite agregar un producto a la cesta
     * @params $objProducto Instancia de Producto
     */
        public static function agregarProducto($objProducto=null){
        if($objProducto==null)
            return false;
        
        if(!isset($_SESSION['cesta']['productos'][$objProducto->inventario_id])){
            $producto=array();
            $producto['inventario_id']=$objProducto->inventario_id;
            $producto['codigo']=$objProducto->codigo;
            $producto['descripcion']=$objProducto->descripcion;
            $producto['inventario']=$objProducto->inventario;
            
            $_SESSION['cesta']['productos'][$objProducto->inventario_id]=$producto;
            unset($producto);            
             Cesta::actualizaTotalProductos();
            return true;
        }
        return false;
    }
    
    /**
     * Metodo que permite remover un producto de la cesta
     * @params $producto_id  Identificador del producto
     */
    public static function removerProducto($producto_id=0){        
        if(isset($_SESSION['cesta']['productos'][$producto_id])){
            unset($_SESSION['cesta']['productos'][$producto_id]);
            Cesta::actualizaTotalProductos();
            return true;
        }
        return false;
    }    
    
    /**
     * Metodo que actualiza el total de productos en la cesta
     * 
     */
    private static function actualizaTotalProductos(){         
         $_SESSION['cesta']['total_items']=isset($_SESSION['cesta']['productos']) ? count($_SESSION['cesta']['productos']) : 0;
    }
    
    /**
     * Metodo que elimina los productos de la cesta
     */
    public static function vaciarCesta(){
        if(isset($_SESSION['cesta']['productos'])){
            $_SESSION['cesta']['productos']=array();
            Cesta::actualizaTotalProductos();
        }
    }
    
}
