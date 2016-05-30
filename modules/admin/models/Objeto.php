<?php

namespace app\modules\admin\models;


use Yii;

class Objeto extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_seguridad.objeto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [          
            [['tipo'], 'string', 'max' => 8],
			[['nombre'], 'string', 'max' => 64],
			[['url'], 'string', 'max' => 255],
            [['tipo','nombre','sistema_id','estado'], 'required'],  
			[['obj_objeto_id','orden','nivel'], 'safe'],			

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'obj_objeto_id' => Yii::t('app', 'Objeto Padre'),
            'sistema_id' => Yii::t('app', 'Número de Sistema'),
			'tipo' => Yii::t('app', 'Tipo'),
			'nombre' => Yii::t('app', 'Nombre'),
			'url' => Yii::t('app', 'Url'),
			'estado' => Yii::t('app', 'Estado'),
			'nivel' => Yii::t('app', 'Nivel'),
			'orden' => Yii::t('app', 'Orden'),
        ];
    }	

}
