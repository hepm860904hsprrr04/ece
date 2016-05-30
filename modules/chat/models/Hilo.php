<?php

namespace app\modules\chat\models;

use Yii;

/**
 * This is the model class for table "{{%ece_mipro_ece_chat.hilo}}".
 *
 * @property integer $hilo_id
 * @property string $cliente_nombre
 * @property string $cliente_session_id
 * @property string $fecha_creacion
 * @property string $fecha_inicio_chat
 * @property string $fecha_modificacion
 * @property string $fecha_cierre
 * @property integer $estatus
 * @property integer $estatus_invitacion
 * @property string $remoto
 * @property string $usuario_session_id
 * @property string $cliente_ultimo_ping
 * @property string $usuario_ultimo_ping
 * @property string $usuario_nombre
 */
class Hilo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ece_mipro_ece_chat.hilo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cliente_nombre'], 'required'],
            [['fecha_creacion', 'fecha_inicio_chat', 'fecha_modificacion', 'fecha_cierre', 'cliente_ultimo_ping', 'usuario_ultimo_ping'], 'safe'],
            [['estatus', 'estatus_invitacion'], 'integer'],
            [['cliente_nombre', 'usuario_nombre'], 'string', 'max' => 64],
            [['cliente_session_id', 'usuario_session_id'], 'string', 'max' => 200],
            [['remoto'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hilo_id' => Yii::t('app', 'Hilo Id'),
            'cliente_nombre' => Yii::t('app', 'Nombre del Cliente'),
            'cliente_session_id' => Yii::t('app', 'Session del Cliente'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creación'),
            'fecha_inicio_chat' => Yii::t('app', 'Fecha Inicio Chat'),
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificación'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
            'estatus' => Yii::t('app', 'Estatus'),
            'estatus_invitacion' => Yii::t('app', 'Estatus Invitación'),
            'remoto' => Yii::t('app', 'Remoto'),
            'usuario_session_id' => Yii::t('app', 'Session del Usuario'),
            'cliente_ultimo_ping' => Yii::t('app', 'Cliente Ultimo Ping'),
            'usuario_ultimo_ping' => Yii::t('app', 'Usuario Ultimo Ping'),
            'usuario_nombre' => Yii::t('app', 'Nombre del Usuario'),
        ];
    }
}
