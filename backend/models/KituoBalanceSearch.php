<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KituoBalance;

/**
 * KituoBalanceSearch represents the model behind the search form about `backend\models\KituoBalance`.
 */
class KituoBalanceSearch extends KituoBalance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kituo_id'], 'integer'],
            [['credit_turn_over', 'debit_turn_over', 'balance'], 'number'],
            [['value_dt', 'updated_by', 'updated_time'], 'safe'],
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
        $query = KituoBalance::find();
        $subquery = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilayas = Wilaya::find()->select('id')->where(['in','mkoa_id',$subquery]);
        $vituos= Vituo::find()->select('id')->where(['in','wilaya_id',$wilayas]);
        $query->where(['in','kituo_id',$vituos]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 100 // in case you want a default pagesize
            ]
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
            'kituo_id' => $this->kituo_id,
            'credit_turn_over' => $this->credit_turn_over,
            'debit_turn_over' => $this->debit_turn_over,
            'balance' => $this->balance,
            'value_dt' => $this->value_dt,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
