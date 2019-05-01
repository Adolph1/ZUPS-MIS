<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProductEventEntry;

/**
 * ProductEventEntrySearch represents the model behind the search form about `backend\models\ProductEventEntry`.
 */
class ProductEventEntrySearch extends ProductEventEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'transaction_code', 'dr_cr_indicator', 'event_code', 'account_role_code', 'role_type', 'mis_head'], 'safe'],
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
        $query = ProductEventEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'transaction_code', $this->transaction_code])
            ->andFilterWhere(['like', 'dr_cr_indicator', $this->dr_cr_indicator])
            ->andFilterWhere(['like', 'event_code', $this->event_code])
            ->andFilterWhere(['like', 'account_role_code', $this->account_role_code])
            ->andFilterWhere(['like', 'role_type', $this->role_type])
            ->andFilterWhere(['like', 'mis_head', $this->mis_head]);

        return $dataProvider;
    }

       public function searchevent($params)
    {
        $query = ProductEventEntry::find();

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

       // if (!($this->load($params) && $this->validate())) {
        //    return $dataProvider;
        //}
         $query->andFilterWhere([
            'product_code' => $params,
        ]);


        //$query->andFilterWhere(['like', 'product_code', $this->product_code]);

        return $dataProvider;
    }
}
