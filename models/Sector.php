<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec_mipro_arancel.sector_industrial".
 *
 * @property integer $sector_industrial_id
 * @property string $nombre_sector
 */
class Sector extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_mipro_arancel.sector_industrial';
    }
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [		
            [['nombre_sector'], 'string', 'max' => 100],
            [['nombre_sector'], 'required'],
            [['estado'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sector_industrial_id' => Yii::t('app', 'Sector Id'),
            'nombre_sector' => Yii::t('app', 'Nombre del Sector'),
            'estado' => Yii::t('app', 'Estatus'),
        ];
    }
    

}
