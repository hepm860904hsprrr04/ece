<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "ec_mipro_ece.candidato".
 *
 * @property integer $sector_industrial_id
 * @property string $cadena_busqueda 
 */
class FormularioFiltro extends Model
{

    public $cadena_busqueda;
    public $sector_industrial_id;    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cadena_busqueda','sector_industrial_id'], 'safe'], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sector_industrial_id' => Yii::t('app', 'Sector Id'),
            'cadena_busqueda' => Yii::t('app', 'Cadena de Busqueda'),
        ];
    }
}
