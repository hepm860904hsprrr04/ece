<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empresa;
use yii\helpers\ArrayHelper;

/**
 * BuscadorEmpresa represents the model behind the search form about `app\models\Empresa`.
 */
class BuscadorEmpresa extends Empresa
{
    
    public static function tableName()
    {
        return 'ec_mipro_ece.vw_empresas';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empresa_id'], 'integer'],
            [['ruc', 'razon_social', 'nombre_comercial', 'codigo_postal', 'estado', 'correo_electronico', 'observacion'], 'safe'],
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
        $query = Empresa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder' => ['empresa_id' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'empresa_id' => $this->empresa_id,
        ]);

        $query->andFilterWhere(['ilike', 'ruc', $this->ruc])
            ->andFilterWhere(['ilike', 'razon_social', $this->razon_social])
            ->andFilterWhere(['ilike', 'nombre_comercial', $this->nombre_comercial])
            ->andFilterWhere(['ilike', 'codigo_postal', $this->codigo_postal])
            ->andFilterWhere(['ilike', 'estado', $this->estado])
            ->andFilterWhere(['ilike', 'correo_electronico', $this->correo_electronico])
            ->andFilterWhere(['ilike', 'observacion', $this->observacion]);

        return $dataProvider;
    }
    
    /**
     *   Metodo que obtiene una empresa
     * 
     **/
    public function obtenerEmpresaPorId($empresa_id=0){  	
        return self::find()    
        ->select('candidato_id,ruc,razon_social,correo_electronico,estado,contrasena')
        ->where('empresa_id='.$empresa_id)
        ->one();                        
    }    
    
    /**
     *   Metodo que devuelve las empresas
     **/
    public static function obtenerEmpresas(){  
        $partidas = self::find()            
        ->orderBy('razon_social')
        ->all();
        return ArrayHelper::map($partidas,'empresa_id','razon_social');
    }    
            
}
