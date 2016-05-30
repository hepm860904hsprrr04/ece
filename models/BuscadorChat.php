<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\Mensa;

/**
 * BuscadorChat represents the model behind the search form about `app\modules\chat\models\Chat`.
 */
class BuscadorChat extends Mensa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','userId'], 'integer'],
            [['message', 'updateDate'], 'safe'],
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
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=>['defaultOrder' => ['id' => 'DESC']]

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
				 

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['ilike', 'message', $this->message])
            ->andFilterWhere(['ilike', 'updateDate', $this->updateDate]);

        return $dataProvider;
    }
	

	
}
