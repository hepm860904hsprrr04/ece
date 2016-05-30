<?php

namespace app\models;

use Yii;

  
/**
 * This is the model class for table "ec_mipro_ece.sector_grupo".
 *
 * @property integer $usuario_id
 * @property string $sector_industrial_id
 */
class SectorUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_mipro_ece.sector_usuario';
    }
	 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id','sector_industrial_id','estado'], 'required'],
            [['usuario_id','sector_industrial_id'], 'integer'], 
            [['usuario_id', 'sector_industrial_id'], 'unique', 'targetAttribute' => ['usuario_id', 'sector_industrial_id']]			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => Yii::t('app', 'Usuario'),
            'sector_industrial_id' => Yii::t('app', 'Sector'),		
            'estado' => Yii::t('app', 'Estado'),	
        ];
    }
}
