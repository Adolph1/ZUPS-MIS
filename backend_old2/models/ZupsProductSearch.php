<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ZupsProduct;

/**
 * ZupsProductSearch represents the model behind the search form about `backend\models\ZupsProduct`.
 */
class ZupsProductSearch extends ZupsProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['product_code', 'maelezo', 'aliyeweka', 'muda'], 'safe'],
            [['kiasi'], 'number'],
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
        $query = ZupsProduct::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kiasi' => $this->kiasi,
            'status' => $this->status,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'maelezo', $this->maelezo])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
