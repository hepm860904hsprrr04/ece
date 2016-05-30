<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\BuscadorCandidato;
use app\models\AppModel;

/**
 * FormularioCandidatoAcceso is the model behind the login form.
 */
class FormularioCandidatoAcceso extends Model
{
    public $ruc;
    public $correo_electronico;
    public $contrasena;    
    public $estado;        

    private $usuario = null;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [            
            [['correo_electronico', 'contrasena', 'ruc'], 'required'],
            [['ruc'], 'match', 'pattern' => '/^[0-9]{10}001$/','message'=> Yii::t('app', 'El RUC ingresado es incorrecto.')], 
            ['contrasena', 'validarContrasena'],
            ['correo_electronico', 'email'],
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
            if ($this->usuario==null){
                $descripcion_mensaje=Yii::t('app', 'El usuario no existe.');
                $this->addError("correo_electronico",$descripcion_mensaje);                
                $this->addError("ruc",$descripcion_mensaje);
            }         
            if ($this->usuario!=null && !($this->usuario->contrasena==AppModel::encriptarCadena($this->contrasena))) {
                $this->addError($attribute, Yii::t('app', 'La contraseña ingresada es incorrecta.'));
            }

            if ($this->usuario!=null && !$this->usuario->estado==="ACTIVO") {
                $this->addError($attribute, Yii::t('app', 'El usuario se encuentra inactivo.'));
            } 
        } 
    }

    /**
     *  Metodo que valida la informacióno ingresa desde el formulario y crea la session de usuario en caso de que este exista
     * @return boolean, true si existe el usuario, false lo contrario
     */
    public function login(){
        if ($this->validate() && !$this->hasErrors()) {
            $_SESSION['ece_postulator']['candidato_id']=$this->usuario->candidato_id;		            
            $_SESSION['ece_postulator']['ruc']=$this->usuario->ruc;
            $_SESSION['ece_postulator']['razon_social']=$this->usuario->razon_social;            
            $_SESSION['ece_postulator']['correo_electronico']=$this->usuario->correo_electronico;            
            $_SESSION['ece_postulator']['estado']=$this->usuario->estado;                         			
            return true;            
        }
        return false;
    }

    /**
     * Metodo que obtiene el usuario correspondiente a ese ruc y correo    
     * @return Candidato
     */
    public function obtenerUsuario(){
        if ($this->usuario === null) {			
            $this->usuario = BuscadorCandidato::obtenerCandidatoPorRucCorreoElectronico(trim($this->ruc),trim($this->correo_electronico)); 
        }
        return $this->usuario;
    }
}