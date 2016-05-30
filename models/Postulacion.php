<?php

namespace app\models;


use Yii;

class Postulacion extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_ece.postulacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [  
            [[ 'postulacion_id'], 'integer'],             
            [[ 'ip_remota','total'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postulacion_id' => Yii::t('app', 'Postulacion Id'),
            'total' => Yii::t('app', 'Total'),
            'ip_remota' => Yii::t('app', 'IP Remota'),
            'fecha_creacion' => Yii::t('app', 'Fecha de Creación'),
        ];
    }
    
	
}
