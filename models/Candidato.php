<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec_mipro_ece.candidato".
 *
 * @property integer $candidato_id
 * @property string $ruc
 * @property string $razon_social
 * @property string $representante_legal
 * @property string $actividad_general
 * @property integer $provincia_id
 * @property integer $canton_id
 * @property string $calle
 * @property string $numero
 * @property string $interseccion
 * @property string $referencia
 * @property string $correo_electronico
 * @property string $telefono_celular
 * @property string $telefono_domicilio
 * @property string $contrasena
 * @property string $estado

 */
class Candidato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $confirmacion_contrasena="";
    
    public static function tableName()
    {
        return 'ec_mipro_ece.candidato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruc','razon_social','actividad_general','provincia_id','canton_id','calle','correo_electronico','telefono_domicilio','contrasena','confirmacion_contrasena'], 'required'],
            [[ 'provincia_id', 'canton_id'], 'integer'],            
            [['razon_social', 'representante_legal','tipo_contribuyente','calle','interseccion','referencia'], 'string', 'max' => 250],            
            [['correo_electronico'], 'string', 'max' => 100],            
            [['actividad_general'], 'string', 'max' => 500],            
            [['telefono_celular', 'telefono_domicilio'], 'string', 'max' => 20],            
            [['correo_electronico'], 'email'],
            //['telefono_domicilio', 'match', 'pattern' => '^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$','message'=> Yii::t('app', 'El número debe ser ingresado a 10 ó 12 digitos.')],
            [['confirmacion_contrasena', 'contrasena'], 'string', 'max' => 11],
            [['confirmacion_contrasena'], 'compare', 'compareAttribute' => 'contrasena'],  
            [['ruc'], 'match', 'pattern' => '/^[0-9]{10}001$/','message'=> Yii::t('app', 'Ruc invalid')], 
            [['ruc', 'correo_electronico'], 'unique', 'targetAttribute' => ['ruc', 'correo_electronico'],'message'=>'El correo electrónico ya fue utilizado con este RUC.'],
            [['ruc','razon_social','actividad_general','calle','correo_electronico','telefono_domicilio','contrasena','telefono_domicilio','confirmacion_contrasena'],'filter','filter'=>'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'candidato_id' => Yii::t('app', 'Candidato Id'),
            'ruc' => Yii::t('app', 'RUC'),
            'razon_social' => Yii::t('app', 'Razon Social'),
            'representante_legal' => Yii::t('app', 'Representante Legal'),
            'actividad_general' => Yii::t('app', 'Actividad'),
            'provincia_id' => Yii::t('app', 'Provincia'),
            'canton_id' => Yii::t('app', 'Canton'),
            'calle' => Yii::t('app', 'Calle'),
            'numero' => Yii::t('app', 'Número'),
            'interseccion' => Yii::t('app', 'Intersección'),
            'referencia' => Yii::t('app', 'Referencia'),
            'correo_electronico' => Yii::t('app', 'Correo Electrónico'),
            'telefono_celular' => Yii::t('app', 'Teléfono Celular'),
            'telefono_domicilio' => Yii::t('app', 'Teléfono Domicilio'),            
            'contrasena' => Yii::t('app', 'Contraseña'),  
            'estado' => Yii::t('app', 'Estado'),
        ];
    }
	
	
    public function sendEmailConfirmation($email=null){		
    $content = "<p>Gracias por tu postulación</p>";        
        echo Yii::$app->mailer->compose("@app/mail/layouts/html", ["content" => $content])
            ->setTo($email)
            ->setFrom([Yii::$app->params["sendmail_from"] =>"Ecuador Compra Ecuador"])
            ->setSubject("Confirmación de Postulacion")
            ->setTextBody("text body")
            ->send();				
    }

    public function sendSimpleEmail($email=null){		
    $content = "Gracias por tu postulación";        /*
            $to = $email;
            $subject = "Confirmación";
            $txt = "Gracias por tu postulación";
            $headers = "From: notificaciones@mipro.gob.ec" . "\r\n" .
            "CC: hepm860904hsprrr04@gmail.com";

            mail($to,$subject,$txt,$headers);	*/

            mail("hepm860904hsprrr04@gmail.com", 'Mi título', "test");
    }	
    
}
