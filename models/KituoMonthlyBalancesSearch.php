<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KituoMonthlyBalances;

/**
 * KituoMonthlyBalancesSearch represents the model behind the search form about `backend\models\KituoMonthlyBalances`.
 */
class KituoMonthlyBalancesSearch extends KituoMonthlyBalances
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kituo_id', 'allocated_to'], 'integer'],
            [['allocated_amount', 'paid_amount', 'balance'], 'number'],
            [['month', 'year', 'allocated_by', 'allocated_time', 'last_access', 'last_access_user','date1','date2'], 'safe'],
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
        $query = KituoMonthlyBalances::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 100 // in case you want a default pagesize
            ]
        ]);
        $subquery = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilayas = Wilaya::find()->select('id')->where(['in','mkoa_id',$subquery]);
        $vituos= Vituo::find()->select('id')->where(['in','wilaya_id',$wilayas]);
        $query->where(['in','kituo_id',$vituos]);
       // $query->groupBy('kituo_id');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kituo_id' => $this->kituo_id,
            'allocated_amount' => $this->allocated_amount,
            'paid_amount' => $this->paid_amount,
            'balance' => $this->balance,
            'allocated_time' => $this->allocated_time,
            'allocated_to' => $this->allocated_to,
            'last_access' => $this->last_access,
        ]);

        $query->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'allocated_by', $this->allocated_by])
            ->andFilterWhere(['like', 'last_access_user', $this->last_access_user]);

        return $dataProvider;
    }
}
