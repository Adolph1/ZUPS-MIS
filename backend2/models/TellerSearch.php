<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Teller;

/**
 * TellerSearch represents the model behind the search form about `backend\models\Teller`.
 */
class TellerSearch extends Teller
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','month'], 'integer'],
            [['reference','pay_point_id', 'year','product', 'trn_dt', 'related_customer', 'offset_account', 'status', 'maker_id', 'maker_time', 'checker_id', 'checker_time'], 'safe'],
            [['amount', 'offset_amount'], 'number'],
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
        $query = Teller::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $mikoa= Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);
        $vituo = Vituo::find()->select('id')->where(['in','wilaya_id',$wilaya]);
        $query->where(['in','pay_point_id',$vituo]);
        $query->andWhere(['month' =>date('m'),'year' => date('Y')]);

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
            'month' => $this->month,
            'year' => $this->year,
            'offset_amount' => $this->offset_amount,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'related_customer', $this->related_customer])
            ->andFilterWhere(['like', 'pay_point_id', $this->pay_point_id])
            ->andFilterWhere(['like', 'offset_account', $this->offset_account])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }

    public function searchPending($params)
    {
        $query = Teller::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $mikoa= Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);
        $vituo = Vituo::find()->select('id')->where(['in','wilaya_id',$wilaya]);
        $query->where(['in','pay_point_id',$vituo]);
        $query->andWhere(['status' => 'U']);

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
            'offset_amount' => $this->offset_amount,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'related_customer', $this->related_customer])
            ->andFilterWhere(['like', 'offset_account', $this->offset_account])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }

   public function pieChart()
    {
        $query=Teller::find();
        $query->where(['status' => 'A']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['pay_point_id','related_customer','amount']);
        //$query->groupBy(['pay_point_id']);
        return $dataProvider;
    }
}
