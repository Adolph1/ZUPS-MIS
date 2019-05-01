<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TodayEntry;

/**
 * TodayEntrySearch represents the model behind the search form about `backend\models\TodayEntry`.
 */
class TodayEntrySearch extends TodayEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['module', 'trn_ref_no', 'trn_dt', 'entry_sr_no', 'ac_no', 'ac_branch', 'event_sr_no', 'event', 'amount_tag', 'drcr_ind', 'trn_code', 'related_customer', 'batch_number', 'product', 'value_dt', 'finacial_year', 'period_code', 'maker_id', 'maker_stamptime', 'checker_id', 'auth_stat', 'delete_stat', 'instrument_code'], 'safe'],
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
    public function search()
    {
        $query = TodayEntry::find();
        $query->where(['between','trn_dt',date('Y-m-01'),date('Y-m-31')]);
        $query->andWhere(['ac_branch' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 100 // in case you want a default pagesize
            ]
        ]);


        return $dataProvider;
    }

    public function searchAllTransactions($gl_acc)
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
        //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'ac_no' => $gl_acc,
            //'trn_dt'=>SystemDate::getCurrentDate(),
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }
    public function searchUnauthorised()
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //$query->andWhere(['!=', 'delete_stat','D']);
        $query->andFilterWhere([
            'auth_stat' => 'U',
            'trn_dt'=>SystemDate::getCurrentDate(),
            'delete_stat'=>null,
        ]);




        return $dataProvider;
    }

    public function searchreversed()
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //if (!($this->load($params) && $this->validate())) {
        //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'event' =>EventType::RVS,
            'trn_dt'=>SystemDate::getCurrentDate(),
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }

    public function searchByReference($params,$cust_no)
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 150,
            ]
        ]);


        $query->andFilterWhere([
            'trn_ref_no' => $params,
            'ac_no'=>$cust_no
        ]);



        return $dataProvider;
    }

    public function lineChart()
    {
        $query=TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['module, sum(amount) AS amount']);
        $query->andWhere(['auth_stat'=>'A']);
        //$query->andFilterWhere(['trn_dt'=>SystemDate::getCurrentDate()]);
        $query->groupBy(['module']);
        return $dataProvider;
    }

    public function lineChart1()
    {
        $query=TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['module,trn_dt,ac_branch, sum(amount) AS amount']);
        $query->andWhere(['event'=>EventType::LQD]);
        $query->andFilterWhere(['trn_dt'=>SystemDate::getCurrentDate()]);
        $query->groupBy(['ac_branch']);
        return $dataProvider;
    }

    public function searchByAccount($account)
    {
        $query = TodayEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 200,
            ]
        ]);

        //if (!($this->load($params) && $this->validate())) {
        //  return $dataProvider;
        //}

        $query->andFilterWhere([
            'ac_no' => $account,
            //'trn_dt'=>SystemDate::getCurrentDate(),
        ]);

        //$query->andFilterWhere(['like', 'auth_stat','U']);


        return $dataProvider;
    }
}
