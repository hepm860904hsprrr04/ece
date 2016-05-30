<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec_mipro_geografico.provincia".
 *
 * @property integer $provincia_id
 * @property string $nombre
 */
class Provincia extends \yii\db\ActiveRecord
{    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_mipro_geografico.provincia';
    }       

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [		
            [['provincia_id'], 'integer'],
            [['nombre'], 'safe'],
        ];
    }    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provincia_id' => Yii::t('app', 'Provincia Id'),
            'nombre' => Yii::t('app', 'Nombre'),			
        ];
    }	    

}
