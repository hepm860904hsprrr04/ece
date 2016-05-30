<?php
namespace app\models;


use Yii;

class PostulacionProducto extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ec_mipro_ece.postulacion_inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [  
            [[ 'postulacion_inventario_id','inventario_id','postulacion_id'], 'integer'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postulacion_inventario_id' => Yii::t('app', 'Postulacion Inventario Id'),
            'inventario_id' => Yii::t('app', 'Inventario Id'),
            'postulacion_id' => Yii::t('app', 'Postulación'),
        ];
    }
   
}
