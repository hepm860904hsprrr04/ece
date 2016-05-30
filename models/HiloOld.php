<?php

namespace app\models;

use Yii;

//  hilo_id integer NOT NULL DEFAULT nextval('ece_mipro_ece_chat.seq_hilo'::regclass), -- identificador del registro
//  cliente_nombre character varying(64), -- nombre con que el cliente se identifica
//  cliente_session_id character varying(200) NOT NULL, -- usuario codificado en md5
//  fecha_creacion date,
//  fecha_inicio_chat timestamp with time zone,
//  fecha_modificacion timestamp with time zone,
//  fecha_cierre timestamp with time zone,
//  estatus integer,
//  remoto character varying(20),
//  usuario_agente character varying(200),
//  cliente_ultimo_ping time without time zone,
//  usuario_ultimo_ping time without time zone,

class Hilo extends \yii\db\ActiveRecord
{
	
    public static function tableName()
    {
        return 'ece_mipro_ece_chat.hilo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [  
            [['cliente_nombre','cliente_session_id','fecha_creacion','estatus'], 'required'],  
             [['fecha_inicio_chat','fecha_modificacion','fecha_cierre','estatus','remoto','cliente_ultimo_ping','usuario_ultimo_ping','cliente_session_id'], 'safe'],               
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cliente_nombre' => Yii::t('app', 'Nombre Cliente'),
            'cliente_session_id' => Yii::t('app', 'Cliente Session Id'),
            'fecha_creacion' => Yii::t('app', 'Fecha de Creación'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
        ];
    }	

}
