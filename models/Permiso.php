<?php

namespace app\models;

use Yii;

  
/**
 * This is the model class for table "ec_mipro_seguridad.permiso".
 *
 * @property integer $grupo_id
 * @property integer $objeto_id
 * @property string $estado
 */
class Permiso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_permisos_objetos';
    }
	 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'integer'],			
            [['url'], 'safe'],			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => Yii::t('app', 'Usuario Id'),
            'url' => Yii::t('app', 'Url'),		            	
        ];
    }
}
