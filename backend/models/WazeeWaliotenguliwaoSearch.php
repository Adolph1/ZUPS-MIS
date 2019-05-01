<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WazeeWaliotenguliwa;

/**
 * WazeeWaliotenguliwaoSearch represents the model behind the search form of `backend\models\WazeeWaliotenguliwa`.
 */
class WazeeWaliotenguliwaoSearch extends WazeeWaliotenguliwa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mzee_id'], 'integer'],
            [['sababu', 'aliyeingiza', 'muda'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = WazeeWaliotenguliwa::find();

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
            'mzee_id' => $this->mzee_id,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'sababu', $this->sababu])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
}
