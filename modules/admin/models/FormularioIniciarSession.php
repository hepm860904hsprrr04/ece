<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use app\models\AppModel;
use app\models\BuscadorUsuario;
use app\models\BuscadorSectorUsuario;
use app\models\BuscadorPermiso;
/**
 * FormularioIniciarSession is the model behind the login form.
 */
class FormularioIniciarSession extends Model{
    public $nombre_usuario;
    public $contrasena;              

    private $usuario = null;

    /**
     * @return array the validation rules.
     */
    public function rules(){
        return [            
            [['nombre_usuario', 'contrasena'], 'required'],
            ['contrasena', 'validarContrasena'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validarContrasena($attribute, $params){        
        if (!$this->hasErrors()) {
            $this->obtenerUsuario();

            if ($this->usuario === null) {
                $this->addError("nombre_usuario", Yii::t('app', 'Acceso denegado.'));
            }  
                                  
            if ($this->usuario!=null && $this->usuario->tipo_usuario!='L' && $this->usuario->contrasena!=AppModel::encriptarCadena($this->contrasena)) {
                $this->addError($attribute, Yii::t('app', 'La contraseña ingresada es incorrecta.'));
            } 		
        } 
    }
	
    /**
     * Logs in a usuario using the provided email and password.
     * @return boolean whether the usuario is logged in successfully
     */
    public function login(){
        if ($this->validate() && !$this->hasErrors()) {  			
            $_SESSION['ece_admin']['usuario_id']=$this->usuario->usuario_id;
            $_SESSION['ece_admin']['usuario']=$this->usuario->usuario;                    			
            $_SESSION['ece_admin']['nombre']=$this->usuario->nombre;
            $_SESSION['ece_admin']['sectores_asignados']=BuscadorSectorUsuario::obtenerSectoresAsignadosPorUsuarioId($this->usuario->usuario_id);            
            
            //Setear configuracion de permisos            
            $_SESSION['ece_admin']['permisos_asignados']=array();
            $_SESSION['ece_admin']['menu']=array();
            //esAdmin indica  si es un administrador o un coordinador 
            $_SESSION['ece_admin']['esAdmin']=BuscadorPermiso::esAdminOCoordinador($this->usuario->usuario_id);
            
            $config_permisos=BuscadorPermiso::obtenerPermisosPorUsuarioId($this->usuario->usuario_id);            
            if(!empty($config_permisos)){
                $_SESSION['ece_admin']['permisos_asignados']=$config_permisos['permisos'];
                $_SESSION['ece_admin']['menu']=$config_permisos['menu'];
            }
            return true;
            
        }
        return false;
    }

    /**
     * Finds usuario by [[ruc,usuario]]
     *
     * @return Usuario | null
     */
    public function obtenerUsuario(){
        if ($this->usuario === null) {
            $this->usuario =  BuscadorUsuario::obtenerUsuarioPorNombreUsuarioContrasena($this->nombre_usuario,$this->contrasena); 
        }

        return $this->usuario;
    }
}
