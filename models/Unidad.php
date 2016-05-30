<?php

namespace app\models;


use Yii;

class Unidad extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_arancel.unidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
            [['abreviatura'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 50],
            [['abreviatura','nombre'], 'required'],            

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unidad_id' => Yii::t('app', 'Unidad Id'),
            'nombre' => Yii::t('app', 'Nombre'),
            'abreviatura' => Yii::t('app', 'Abreviatura'),
        ];
    }	

}
