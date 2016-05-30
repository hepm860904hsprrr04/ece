<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/**
 * BuscadorUsuario represents the model behind the search form about `app\models\Usuario`.
 */
class BuscadorUsuario extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id','empresa_id','region_senplades_id','provincia_id'], 'integer'],
            [['nombre','apellido','usuario','contrasena','estado','correo_electronico_usuario','tipo_usuario','usuario_estado','empresa_estado'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Periodo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['usuario_id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'usuario_id' => $this->usuario_id,
        ]);

        $query->andFilterWhere(['ilike', 'abreviatura', $this->abreviatura]);
        $query->andFilterWhere(['ilike', 'usuario', $this->usuario]);

        return $dataProvider;
    }
	
	
    /**
     *   Obtiene un usuario por su nombre de usuaio y contrasena
     **/	
    public static function obtenerUsuarioPorNombreUsuarioContrasena($usuario,$contrasena){  	
            $clave_cifrada=  AppModel::encriptarCadena($contrasena);            
//            $clave_cifrada="cbd20b1d1d8b2b8151117eb43a7cfb3a9c3362ce";
            $sql_string="
            SELECT 
                usuario_id
                ,usuario 
                ,contrasena
                ,documento_identidad as documento
                ,tipo_usuario
                ,estado
                FROM ec_mipro_seguridad.usuario 
                WHERE 
                usuario = '$usuario'  AND estado='ACTIVO' 
                AND (
                    contrasena = '$clave_cifrada'
                    OR tipo_usuario = 'L'
                )
            ";						
            $objUsuario=self::findBySql($sql_string)->one();
			
            if($objUsuario!=null){  
                //Obtener el grupo del usuario                               
                if($objUsuario->tipo_usuario=='L'){
                    $result=  AppModel::ejecutarComando('php', "<?php echo ldap_bind(ldap_connect('ldap://192.168.2.17'), '$usuario@MICIPUIO', '$contrasena');");      
                     if (!empty($result) && $result['stdout'] === "1") {
                        return $objUsuario;
                    } else {
                        return null;
                    }					
                }else{
                    return $objUsuario;
                }
            }  
    } 
    
    /**
     * Metodo que devuelve la lista de sectorialistas
     */
    public static function obtenerSectorialistas(){
        $cadena_consulta="select * from ec_mipro_ece.vw_usuario where nombre_grupo ilike '%sectorialista%' order by usuario asc";        
        return ArrayHelper::map(self::findBySql($cadena_consulta)->all(),'usuario_id','usuario');               
    }
	
    

}
