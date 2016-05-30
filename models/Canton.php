<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ec_mipro_geografico.canton".
 *
 * @property integer $canton_id
 * @property integer $provincia_id
 * @property string $nombre
 */
class Canton extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_mipro_geografico.canton';
    }

    public function getCitiesByStateId($state_id=0){
        return  ArrayHelper::map(Canton::find()->where(['provincia_id'=>$state_id])->all(), 'canton_id', 'nombre');
    }
}
