<?php

namespace app\models;
use Yii;
use app\models\AppModel;

/**
 * This is the model class for table "ec_mipro_seguridad.usuario". 
 * @property integer $usuario_id
 * @property integer $empresa_id
 * @property integer $region_senplades_id
 * @property string $nombre
 * @property string $apellido
 * @property integer $documento_identidad_id
 * @property string $usuario
 * @property string $contrasena
 * @property string $tipo_usuario
 * @property string $estado
 * @property integer $provincia_id
 * @property string $correo_electronico
 */
class Usuario extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'ec_mipro_seguridad.usuario';
    }

    /**
     * @inheritdoc
     */
    public static function obtenerUsuarioPorId($usuario_id=0){
        return self::findOne($usuario_id);
    }

    /**
     * @inheritdoc
     */
    public static function obtenerUsuarioPorTokenDeAcceso($token, $type = null)
    {
        return null;
    }


    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id=$id;
    }  

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function setUsuarioName($username)
    {
        $this->username=$username;
        //$this->username=$email;
    }  

    /**
     * @inheritdoc
     */
    public function getUsuarioName()
    {
        return $this->username;
    }    

    /**
     * @inheritdoc
     */
    public function setPassword($password)
    {
        $this->password=$password;
    }   

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->password;
    }     


    /**
     * @inheritdoc
     */
    public function setAliasName($aliasName)
    {
        $this->aliasName=$aliasName;
    }   

    /**
     * @inheritdoc
     */
    public function getAliasName()
    {
        return $this->full_name;
    }  

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {
        $this->status=intval($status);
    }   

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->status;
    }      

    /**
     * @inheritdoc
     */
    public function setUsuarioGroupId($user_group_id)
    {
        $this->user_group_id=$user_group_id;
    }   

    /**
     * @inheritdoc
     */
    public function getUsuarioGroupId()
    {
        return $this->user_group_id;
    }    

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {        
      
        return $this->getPassword() === md5($password);
    }

    /**
     * Validates status
     *    
     * @return boolean status current user
     */
    public function validateStatus()
    {        
        return $this->getStatus() === 1;
    }

    public static function obtenerUsuarioId(){
        return $_SESSION['ece_admin']['usuario_id'] ;       
    }

}
