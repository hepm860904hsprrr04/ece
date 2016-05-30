<?php

namespace app\models;

use Yii;

class Periodo extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_ece.periodo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
            [['descripcion'], 'string', 'max' => 30],
            [['descripcion'], 'required'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'periodo_id' => Yii::t('app', 'Periodo Id'),
            'descripcion' => Yii::t('app', 'Descripción'),
        ];
    }	

}
