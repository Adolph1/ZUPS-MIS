<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CashierAccount;

/**
 * CashierAccountSearch represents the model behind the search form about `backend\models\CashierAccount`.
 */
class CashierAccountSearch extends CashierAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cashier_id'], 'integer'],
            [['account', 'maker_id','status', 'maker_time'], 'safe'],
            [['opening_balance', 'current_balance'], 'number'],
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
        $query = CashierAccount::find();

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
        $query->where(['status' => null]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cashier_id' => $this->cashier_id,
            'opening_balance' => $this->opening_balance,
            'current_balance' => $this->current_balance,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
