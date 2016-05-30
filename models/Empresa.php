<?php

namespace app\models;


use Yii;

class Empresa extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_seguridad.empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
            [['ruc'], 'string', 'max' => 13],
            [['ruc'], 'match', 'pattern' => '/^[0-9]{10}001$/','message'=> Yii::t('app', 'El RUC ingresado es incorrecto.')], 
            [['razon_social','nombre_comercial'], 'string', 'max' => 128],
            [['codigo_postal'], 'string', 'max' => 8],
            [['estado'], 'string', 'max' => 8],
            [['correo_electronico'], 'string', 'max' => 100],
            [['observacion'], 'string', 'max' => 200],
            [['ruc','razon_social','nombre_comercial','estado'], 'required'],            
            [['correo_electronico'], 'email'],
            [['ruc'], 'match', 'pattern' => '/^[0-9]{10}001$/','message'=> Yii::t('app', 'El RUC ingresado no es valido')], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'empresa_id' => Yii::t('app', 'Empresa Id'),
            'ruc' => Yii::t('app', 'RUC'),            
            'razon_social' => Yii::t('app', 'Razon Social'),
            'codigo_postal' => Yii::t('app', 'Código Postal'),
            'nombre_comercial'=> Yii::t('app', 'Nombre Comercial'),
            'estado' => Yii::t('app', 'Estado'),
            'correo_electronico' => Yii::t('app', 'Correo Electrónico'),
            'observacion' => Yii::t('app', 'Observación'),
        ];
    }	

}
