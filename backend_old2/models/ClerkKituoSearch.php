<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ClerkKituo;

/**
 * ClerkKituoSearch represents the model behind the search form about `backend\models\ClerkKituo`.
 */
class ClerkKituoSearch extends ClerkKituo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kituo_id', 'user_id', 'status'], 'integer'],
            [['date_assigned', 'maker_id', 'maker_time'], 'safe'],
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
        $query = ClerkKituo::find();

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
            'kituo_id' => $this->kituo_id,
            'user_id' => $this->user_id,
            'date_assigned' => $this->date_assigned,
            'status' => $this->status,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
