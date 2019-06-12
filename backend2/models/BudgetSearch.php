<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Budget;

/**
 * BudgetSearch represents the model behind the search form about `backend\models\Budget`.
 */
class BudgetSearch extends Budget
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['maelezo', 'kumbukumbu_no', 'kwa_mwezi', 'kwa_mwaka', 'aliyeweka', 'muda', 'aliyethitisha', 'muda_kuthibitisha','date1','date2'], 'safe'],
            [['jumla_kiasi'], 'number'],
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
        $query = Budget::find();
        $query->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->orderBy(['kwa_mwezi'=>SORT_DESC,'kwa_mwaka'=>SORT_DESC]);

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
            'jumla_kiasi' => $this->jumla_kiasi,
            'status' => $this->status,
            'muda' => $this->muda,
            'muda_kuthibitisha' => $this->muda_kuthibitisha,
        ]);

        $query->andFilterWhere(['like', 'maelezo', $this->maelezo])
            ->andFilterWhere(['like', 'kumbukumbu_no', $this->kumbukumbu_no])
            ->andFilterWhere(['like', 'kwa_mwezi', $this->kwa_mwezi])
            ->andFilterWhere(['like', 'kwa_mwaka', $this->kwa_mwaka])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['between', 'muda', $this->date1,$this->date2])
            ->andFilterWhere(['like', 'aliyethitisha', $this->aliyethitisha]);

        return $dataProvider;
    }

    public function searchPending($params)
    {
        $query = Budget::find();
        $query->where(['status' => Budget::OPEN]);

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
            'jumla_kiasi' => $this->jumla_kiasi,
            'status' => $this->status,
            'muda' => $this->muda,
            'muda_kuthibitisha' => $this->muda_kuthibitisha,
        ]);

        $query->andFilterWhere(['like', 'maelezo', $this->maelezo])
            ->andFilterWhere(['like', 'kumbukumbu_no', $this->kumbukumbu_no])
            ->andFilterWhere(['like', 'kwa_mwezi', $this->kwa_mwezi])
            ->andFilterWhere(['like', 'kwa_mwaka', $this->kwa_mwaka])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'aliyethitisha', $this->aliyethitisha]);

        return $dataProvider;
    }

    public function searchMonthly($id)
    {
        $query = Budget::find();
        $query->where(['zups_budget_id' => $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jumla_kiasi' => $this->jumla_kiasi,
            'status' => $this->status,
            'muda' => $this->muda,
            'muda_kuthibitisha' => $this->muda_kuthibitisha,
        ]);

        $query->andFilterWhere(['like', 'maelezo', $this->maelezo])
            ->andFilterWhere(['like', 'kumbukumbu_no', $this->kumbukumbu_no])
            ->andFilterWhere(['like', 'kwa_mwezi', $this->kwa_mwezi])
            ->andFilterWhere(['like', 'kwa_mwaka', $this->kwa_mwaka])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'aliyethitisha', $this->aliyethitisha]);

        return $dataProvider;
    }
}
