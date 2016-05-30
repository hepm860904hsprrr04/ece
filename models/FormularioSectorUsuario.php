<?php

namespace app\models;


use Yii;

class FormularioSectorUsuario extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'ec_mipro_ece.sector_usuario';
    }    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
            [['usuario_id','sector_industrial_id'], 'required'],            
            [['usuario_id','sector_industrial_id'], 'integer'],   
            [['usuario_id'], 'unique', 'targetAttribute' => ['usuario_id','sector_industrial_id'],'message'=>'El sectorialista ya fue agregado a este sector.']
        ];
    }
    
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sector_industrial_id' => Yii::t('app', 'Sector'),
            'usuario_id' => Yii::t('app', 'Sectorialista'),            
                   
        ];
    }	    

}