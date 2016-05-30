<?php
namespace app\models;


use Yii;

class CandidatoPostulacion extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_ece.candidato_postulacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [  
            [[ 'candidato_postulacion_id','candidato_id','postulacion_id'], 'integer'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'candidato_postulacion_id' => Yii::t('app', 'Candidato Postulación Id'),
            'candidato_id' => Yii::t('app', 'Candidato'),
            'postulacion_id' => Yii::t('app', 'Postulación'),
        ];
    }
   
}
