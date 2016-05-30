<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Permiso;

/**
 * BuscadorPermiso represents the model behind the search form about `app\models\Permiso`.
 */
class BuscadorPermiso extends Permiso
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'safe'],
        ];
    }
    
    /**
     * Metodo que obtiene los permisos relacionados a un usuario
     * @param integer $usuario_id Número de usuario
     */
    public static function obtenerPermisosPorUsuarioId($usuario_id=0){
        $config_permisos=array("permisos"=>array(),"menu"=>array());
         $permisos = self::find() 
        ->select('objeto_id,nombre,url,obj_objeto_id')
        ->where(['usuario_id'=>$usuario_id])
        ->orderBy('objeto_id,orden asc')
        ->all();             
        if($permisos!=null){            
            $permisos_asignados=array();
            foreach($permisos as $permiso){  
                 $permisos_asignados[]=$permiso->url;
                if($permiso->obj_objeto_id===null && !isset($config_permisos['menu'][$permiso->objeto_id])){
                    $config_permisos['menu'][$permiso->objeto_id]=array('label'=>$permiso->nombre,'url'=>array($permiso->url));
                }
            }
            $config_permisos['permisos']=$permisos_asignados;
            
            return $config_permisos;
        }
        return array();
    }
    
    
    public static function esAdminOCoordinador($usuario_id=0){
        $cadena_consulta="SELECT g.nombre,u.nombre,u.usuario_id FROM ec_mipro_seguridad.grupo g 
            join ec_mipro_seguridad.asignacion a on a.grupo_id=g.grupo_id
            join ec_mipro_seguridad.usuario u on u.usuario_id=a.usuario_id 
            where g.sistema_id=4  and u.usuario_id=".$usuario_id." and (g.nombre ilike '%administrador%' or g.nombre ilike '%coordinador%') limit 1;
            ";
        $consulta=self::findBySql($cadena_consulta)->all();
        if($consulta!=null){
            return true;
        }           
        return false;
    }    

}
