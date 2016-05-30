<?php
namespace app\modules\empresa\models;

use Yii;
use yii\base\Model;
use app\models\AppModel;
use app\modules\empresa\models\UsuarioEmpresa;
/**
 * FormularioLogin is the model behind the login form.
 */
class FormularioLogin extends Model{
    public $ruc;
    public $nombre_usuario;
    public $contrasena;              

    private $usuario = null;


    /**
     * @return array the validation rules.
     */
    public function rules(){
        return [            
            [['nombre_usuario', 'contrasena', 'ruc'], 'required'],
            [['ruc'], 'match', 'pattern' => '/^[0-9]{10}001$/','message'=> Yii::t('app', 'El RUC ingresado es invalido.')], 
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
                $this->addError("nombre_usuario", Yii::t('app', 'El usuario no existe.'));
            }  
            if ($this->usuario!=null && $this->usuario->estado_usuario!="ACTIVO"){
                $this->addError("nombre_usuario", Yii::t('app', 'El usuario se encuentra inactivo.'));
            } 
            
            if ($this->usuario!=null && $this->usuario->usuario_empresa_estado!="ACTIVO"){
                $this->addError("nombre_usuario", Yii::t('app', 'El usuario se encuentra inactivo.'));
            } 
            
            if ($this->usuario!=null && $this->usuario->estado_empresa!="ACTIVO"){
                $this->addError("nombre_usuario", Yii::t('app', 'La empresa se encuentra inactiva.'));
            }             
            
            if ($this->usuario!=null || ($this->usuario->contrasena!=AppModel::encriptarCadena($this->contrasena))) {
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
            $_SESSION['ece_empresa']['empresa_id']=$this->usuario->empresa_id;
            $_SESSION['ece_empresa']['ruc']=$this->usuario->ruc;
            $_SESSION['ece_empresa']['usuario']=$this->usuario->usuario;            
            $_SESSION['ece_empresa']['nombre']=$this->usuario->nombre;            
            $_SESSION['ece_empresa']['usuario_id']=$this->usuario->usuario_id;                        
            $_SESSION['ece_empresa']['razon_social']=$this->usuario->razon_social;            			
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
            $this->usuario = UsuarioEmpresa::obtenerUsuarioPorRucNombreUsuario($this->ruc,$this->nombre_usuario); 
        }

        return $this->usuario;
    }
}
