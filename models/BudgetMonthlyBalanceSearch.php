<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BudgetMonthlyBalance;

/**
 * BudgetMonthlyBalanceSearch represents the model behind the search form of `backend\models\BudgetMonthlyBalance`.
 */
class BudgetMonthlyBalanceSearch extends BudgetMonthlyBalance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'budget_id'], 'integer'],
            [['opening_balance', 'closing_balance', 'balance'], 'number'],
            [['last_update', 'updated_by'], 'safe'],
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
        $query = BudgetMonthlyBalance::find();

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
            'budget_id' => $this->budget_id,
            'opening_balance' => $this->opening_balance,
            'closing_balance' => $this->closing_balance,
            'balance' => $this->balance,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
