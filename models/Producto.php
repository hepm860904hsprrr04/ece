<?php
namespace app\models;


use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "ec_mipro_ece.inventario".
 *
 * @property integer $inventario_id, Identificador 
 * @property integer $empresa_id, Identificador de la empresa  
 * @property string $inventario, Descripción corta 
 * @property string $descripcion, Descripción larga 
 * @property string $codigo, Código del producto
 * @property numeric $volumen_minimo, Volumen Minimo
 * @property numeric $volumen_maximo, Volumen Maximo
 * @property integer $unidad_id
 * @property integer $periodo_id
 * @property integer $partida_id
 * @property integer $ubicacion_necesidad_id
 * @property numeric $precio_referencia_min
 * @property numeric $precio_referencia_maximo
 * @property string $foto  Representa el nombre de la imagen del producto
 * @property string $anexo
 * @property string $observaciones
 * @property boolean $publicado
 * @property integer $sector_industrial_id
 * @property integer $aliado_id
 * @property integer $creado_por
 * @property timestamp $fecha_creacion
 * @property integer $modificado_por
 * @property timestamp $fecha_modificacion
 * @property integer $asignado_a
 * @property timestamp $fecha_asignación
 * @property integer $total_postulacion .- Representa el total de postulaciones que el producto a recibido
 */
class Producto extends \yii\db\ActiveRecord
{


    public $imageFile;    
	
    public static function tableName()
    {
        return 'ec_mipro_ece.inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creado_por', 'modificado_por','unidad_id','periodo_id','partida_id','aliado_id', 'sector_industrial_id','ubicacion_necesidad_id'], 'integer'],
            [['volumen_minimo', 'precio_referencia_min', 'volumen_maximo', 'precio_referencia_maximo'], 'number'],
            [['publicado'], 'boolean'],
            [['observaciones','anexo'], 'safe'],
            [['inventario'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 400],            			
            [['codigo'], 'string', 'max' => 50],
            [['inventario','codigo','sector_industrial_id','descripcion'], 'required'],
            [['imageFile'], 'file',  'extensions' => 'png, jpg'],
            [['codigo', 'empresa_id'], 'unique', 'targetAttribute' => ['codigo'],'message'=>'El código ingresado ya esta siendo utilizado por otro producto.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventario_id' => Yii::t('app', 'Producto Id'),
            'empresa_id' => Yii::t('app', 'Empresa Id'),
            'inventario' => Yii::t('app', 'Producto'),
            'descripcion' => Yii::t('app', 'Descripción'),
            'codigo' => Yii::t('app', 'Código'),
            'volumen_maximo' => Yii::t('app', 'Volumen Minimo'),
            'volumen_maximo' => Yii::t('app', 'Volumen Máximo'),
            'unidad_id' => Yii::t('app', 'Unidad de Medida'),            
            'periodo_id' => Yii::t('app', 'Periodo Consumo'),            
            'partida_id' => Yii::t('app', 'Partida Arancelaria'),
            'ubicacion_id' => Yii::t('app', 'Ubicacion Necesidad'),
            'precio_referencia_min' => Yii::t('app', 'Precio Referencial Minimo'),
            'precio_referencia_maximo' => Yii::t('app', 'Precio Referencial Máximo'),
            'foto' => Yii::t('app', 'Foto'),
            'anexo' => Yii::t('app', 'Anexo'),
            'observaciones' => Yii::t('app', 'Observaciones'),
            'publicado' => Yii::t('app', 'Publicado'),
            'sector_industrial_id' => Yii::t('app', 'Sector Id'),
            'aliado_id' => Yii::t('app', 'Aliado Id'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creación'),
            'modificado_por' => Yii::t('app', 'Modificado Por'),                                                        
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificación'),
            'asignado_a' => Yii::t('app', 'Asignado a'),
            'fecha_asignacion' => Yii::t('app', 'Fecha de Asignación'),
            'total_postulacion' => Yii::t('app', 'Total de Postulaciones'),
            'razon_social' => Yii::t('app', 'Empresa'),
            'nombre_sector' => Yii::t('app', 'Sector'),
        ];
    }


    
}
