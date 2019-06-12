<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ToaMafuta;

/**
 * ToaMafutaSearch represents the model behind the search form of `backend\models\ToaMafuta`.
 */
class ToaMafutaSearch extends ToaMafuta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'wilaya_id', 'bidhaa_id', 'gari'], 'integer'],
            [['tarehe', 'vocha', 'maker_id', 'maker_time'], 'safe'],
            [['kiasi'], 'number'],
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
        $query = ToaMafuta::find();

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
            'tarehe' => $this->tarehe,
            'wilaya_id' => $this->wilaya_id,
            'bidhaa_id' => $this->bidhaa_id,
            'gari' => $this->gari,
            'kiasi' => $this->kiasi,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'vocha', $this->vocha])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
