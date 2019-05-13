<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GlDailyBalance;

/**
 * GlDailyBalanceSearch represents the model behind the search form about `backend\models\GlDailyBalance`.
 */
class GlDailyBalanceSearch extends GlDailyBalance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['trn_date', 'gl_code'], 'safe'],
            [['opening_balance', 'dr_turn', 'cr_turn', 'closing_balance'], 'number'],
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
        $query = GlDailyBalance::find();

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
            'trn_date' => $this->trn_date,
            'opening_balance' => $this->opening_balance,
            'dr_turn' => $this->dr_turn,
            'cr_turn' => $this->cr_turn,
            'closing_balance' => $this->closing_balance,
        ]);

        $query->andFilterWhere(['like', 'gl_code', $this->gl_code]);

        return $dataProvider;
    }
}
