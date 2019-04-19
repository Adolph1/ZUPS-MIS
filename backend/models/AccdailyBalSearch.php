<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccdailyBal;

/**
 * AccdailyBalSearch represents the model behind the search form about `backend\models\AccdailyBal`.
 */
class AccdailyBalSearch extends AccdailyBal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['branch_code', 'account', 'value_date'], 'safe'],
            [['available_balance', 'Debit_tur', 'Cedit_tur'], 'number'],
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
        $query = AccdailyBal::find();

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
            'value_date' => $this->value_date,
            'available_balance' => $this->available_balance,
            'Debit_tur' => $this->Debit_tur,
            'Cedit_tur' => $this->Cedit_tur,
        ]);

        $query->andFilterWhere(['like', 'branch_code', $this->branch_code])
            ->andFilterWhere(['like', 'account', $this->account]);

        return $dataProvider;
    }

    public function searchBalance($params)
    {
        $query = AccdailyBal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 150,
            ]
        ]);


        $query->andFilterWhere([
            'account' => $params,
            //'status'=>'A'
        ]);



        return $dataProvider;
    }

    public function searchAll()
    {
        $query=AccdailyBal::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['account',])->distinct();
        $query->orderBy('id DESC');
        return $dataProvider;
    }

    public function searchToday($params)
    {
        $query = AccdailyBal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
       // $query->where(['value_date' => date('Y-m-d')]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'value_date' => $this->value_date,
            'available_balance' => $this->available_balance,
            'Debit_tur' => $this->Debit_tur,
            'Cedit_tur' => $this->Cedit_tur,
        ]);

        $query->andFilterWhere(['like', 'branch_code', $this->branch_code])
            ->andFilterWhere(['like', 'account', $this->account]);

        return $dataProvider;
    }
}
