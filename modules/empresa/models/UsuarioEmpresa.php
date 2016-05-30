<?php

namespace app\modules\empresa\models;

use Yii;
                
/**
 * This is the model class for table "ec_mipro_ece.vw_empresas_usuarios".
 *
 * @property integer $usuario_id
 * @property string $nombre
 * @property string $apellido
 * @property string $usuario
 * @property string $contrasena
 * @property string $tipo_usuario
 * @property string $estado_usuario
 * @property string $correo_electonico_usuario 
 * @property integer $empresa_id
 * @property string $ruc
 * @property string $razon_social
 * @property string $nombre_comercial
 * @property string $estado_empresa
 * @property string $correo_electronico_empresa
 */
class UsuarioEmpresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_usuarios_empresas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'empresa_id'], 'integer'],
            [['usuario','nombre','apellido','usuario','contrasena','estado_usuario','tipo_usuario','correo_electronico_usuario','ruc','razon_social','nombre_comercial','estado_empresa','correo_electronico_empresa'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => Yii::t('app', 'Usuario Id'),
        ];
    }

    public static function obtenerUsuarioPorRucNombreUsuario($ruc,$usuario){
       return self::find()            
        ->where(['ruc'=>$ruc,'usuario'=>$usuario])
        ->one();    
    }

}
