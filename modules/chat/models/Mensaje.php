<?php

namespace app\modules\chat\models;

use Yii;

/**
 * This is the model class for table "{{%ece_mipro_ece_chat.mensaje}}".
 *
 * @property integer $mensaje_id
 * @property integer $hilo_id
 * @property integer $tipo
 * @property string $mensaje_texto
 * @property string $fecha_creacion
 * @property string $cliente_session_id
 * @property string $usuario_session_id
 */
class Mensaje extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ece_mipro_ece_chat.mensaje';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hilo_id', 'tipo', 'mensaje_texto'], 'required'],
            [['hilo_id', 'tipo'], 'integer'],
            [['mensaje_texto'], 'string'],
            [['fecha_creacion'], 'safe'],
            [['cliente_session_id', 'usuario_session_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mensaje_id' => Yii::t('app', 'Mensaje ID'),
            'hilo_id' => Yii::t('app', 'Hilo ID'),
            'tipo' => Yii::t('app', 'Tipo'),
            'mensaje_texto' => Yii::t('app', 'Mensaje Texto'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'cliente_session_id' => Yii::t('app', 'Cliente Session ID'),
            'usuario_session_id' => Yii::t('app', 'Usuario Session ID'),
        ];
    }

}
