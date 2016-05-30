<?php

namespace app\models;


use Yii;

class Aliado extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_ece.aliado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [                      
            [['nombre_aliado'], 'string', 'max' => 30],
            [['nombre_aliado'], 'required'],            

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aliado_id' => Yii::t('app', 'Aliado Id'),
            'nombre_aliado' => Yii::t('app', 'Aliado'),			
        ];
    }	

}
