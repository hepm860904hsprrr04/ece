<?php

namespace app\models;
use Yii;
use app\models\AppModel;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "ec_mipro_seguridad.vw_obtener_usuarios_conectados". 
 */
class VwUsuarioConectado extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'ece_mipro_ece_chat.vw_obtener_usuarios_conectados';
    }
    
    public function obtenerUsuariosConectados()
    {
        $query = VwUsuarioConectado::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>false
        ]);

        $query->andFilterWhere([
            //'unidad_id' => $this->unidad_id,
        ]);

        return $dataProvider;
    }    
}
