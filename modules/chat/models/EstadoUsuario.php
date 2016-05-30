<?php

namespace app\modules\chat\models;

use Yii;

/**
 * This is the model class for table "{{%ece_mipro_ece_chat.estado_usuario}}".
 *
 * @property integer $estado_usuario_id
 * @property integer $usuario_id
 * @property string $estado
 * @property string $fecha_ultima_conexion
 * @property string $ultimo_ping
 * @property string $alias
 * @property string $session_id
 */
class EstadoUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ece_mipro_ece_chat.estado_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'integer'],
            [['fecha_ultima_conexion', 'ultimo_ping'], 'safe'],
            [['estado'], 'string', 'max' => 20],
            [['alias'], 'string', 'max' => 100],
            [['session_id'], 'string', 'max' => 200],
            [['usuario_id'], 'unique'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'estado_usuario_id' => Yii::t('app', 'Estado Usuario ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'estado' => Yii::t('app', 'Estado'),
            'fecha_ultima_conexion' => Yii::t('app', 'Fecha Ultima Conexion'),
            'ultimo_ping' => Yii::t('app', 'Ultimo Ping'),
            'alias' => Yii::t('app', 'Alias'),
            'session_id' => Yii::t('app', 'Session ID'),
        ];
    }


}
