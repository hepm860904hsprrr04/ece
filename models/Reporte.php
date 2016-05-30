<?php

namespace app\models;


use Yii;

class Reporte extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_reporte_postulaciones_x_mes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ano' => Yii::t('app', 'Año'),
            'mes' => Yii::t('app', 'Mes'),
            'total' => Yii::t('app', 'Total'),			
        ];
    }	

}
