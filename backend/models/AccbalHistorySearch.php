<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccbalHistory;

/**
 * AccbalHistorySearch represents the model behind the search form about `backend\models\AccbalHistory`.
 */
class AccbalHistorySearch extends AccbalHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['branch_code', 'account', 'bkg_date'], 'safe'],
            [['acy_opening_balance', 'acy_closing_balance', 'acy_dr_tur', 'acy_cr_tur', 'available_closing', 'acy_closing_uncoll'], 'number'],
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
        $query = AccbalHistory::find();

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
            'bkg_date' => $this->bkg_date,
            'acy_opening_balance' => $this->acy_opening_balance,
            'acy_closing_balance' => $this->acy_closing_balance,
            'acy_dr_tur' => $this->acy_dr_tur,
            'acy_cr_tur' => $this->acy_cr_tur,
            'available_closing' => $this->available_closing,
            'acy_closing_uncoll' => $this->acy_closing_uncoll,
        ]);

        $query->andFilterWhere(['like', 'branch_code', $this->branch_code])
            ->andFilterWhere(['like', 'account', $this->account]);

        return $dataProvider;
    }
}
