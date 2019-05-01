<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CashBook;

/**
 * CashBookSearch represents the model behind the search form about `backend\models\CashBook`.
 */
class CashBookSearch extends CashBook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['trn_dt', 'gl_account', 'dr_cr', 'description', 'auth_stat', 'delete_stat', 'maker_id', 'maker_time'], 'safe'],
            [['amount'], 'number'],
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
        $query = CashBook::find();

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
            'trn_dt' => $this->trn_dt,
            'amount' => $this->amount,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'gl_account', $this->gl_account])
            ->andFilterWhere(['like', 'dr_cr', $this->dr_cr])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'auth_stat', $this->auth_stat])
            ->andFilterWhere(['like', 'delete_stat', $this->delete_stat])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
