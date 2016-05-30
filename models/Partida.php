<?php

namespace app\models;

use Yii;


class Partida extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_arancel.partida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
            [['codigo_partida'], 'string', 'max' => 30],
            [['codigo_partida_formato'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 400],			
            [['codigo_partida','codigo_partida_formato','descripcion'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'partida_id' => Yii::t('app', 'Partida Id'),
            'codigo_partida' => Yii::t('app', 'Codigo'),
            'codigo_partida_formato' => Yii::t('app', 'Codigo Partida Formato'),
        ];
    }	

}
