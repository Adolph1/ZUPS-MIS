<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MahesabuBreakdown;

/**
 * MahesabuBreakdownSearch represents the model behind the search form about `backend\models\MahesabuBreakdown`.
 */
class MahesabuBreakdownSearch extends MahesabuBreakdown
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mahesabu_id'], 'integer'],
            [['kiasi_kilichobaki'], 'number'],
            [['tarehe'], 'safe'],
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
        $query = MahesabuBreakdown::find();

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
            'mahesabu_id' => $this->mahesabu_id,
            'kiasi_kilichobaki' => $this->kiasi_kilichobaki,
            'tarehe' => $this->tarehe,
        ]);

        return $dataProvider;
    }
}
