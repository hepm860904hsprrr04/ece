<?php

namespace app\models;


use Yii;

class Mensa extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_ece.chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [                                  
            [['message','userId','updateDate'], 'safe'],            

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message' => Yii::t('app', 'Mensaje'),
            'userId' => Yii::t('app', 'Nombre de Usuario'),			
			'updateDate' => Yii::t('app', 'Fecha'),			
        ];
    }	
	
	
	

}
