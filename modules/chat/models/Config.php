<?php

namespace app\modules\chat\models;

use Yii;

/**
 * This is the model class for table "{{%ece_mipro_ece_chat.config}}".
 *
 * @property integer $config_id
 * @property string $clave
 * @property string $valor
 */
class Config extends \yii\db\ActiveRecord
{

    public $imageFile;  
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ece_mipro_ece_chat.config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clave'], 'string', 'max' => 100],
            [['valor'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'config_id' => Yii::t('app', 'Config ID'),
            'clave' => Yii::t('app', 'Clave'),
            'valor' => Yii::t('app', 'Valor'),
        ];
    }

}
