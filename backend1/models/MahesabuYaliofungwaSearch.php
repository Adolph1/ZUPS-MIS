<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MahesabuYaliofungwa;

/**
 * MahesabuYaliofungwaSearch represents the model behind the search form about `backend\models\MahesabuYaliofungwa`.
 */
class MahesabuYaliofungwaSearch extends MahesabuYaliofungwa
{
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id', 'cashier_id', 'kituo_id'], 'integer'],
            [['tarehe_ya_kupewa', 'tarehe_ya_kufunga', 'maelezo_zaid', 'status', 'aliyepokea', 'muda'], 'safe'],
            [['kiasi_alichopewa', 'kiasi_kilichotumika', 'kiasi_alichorudisha', 'kiasi_kilichobaki'], 'number'],
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
        $query = MahesabuYaliofungwa::find();

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
            'tarehe_ya_kupewa' => $this->tarehe_ya_kupewa,
            'cashier_id' => $this->cashier_id,
            'kituo_id' => $this->kituo_id,
            'kiasi_alichopewa' => $this->kiasi_alichopewa,
            'kiasi_kilichotumika' => $this->kiasi_kilichotumika,
            'kiasi_alichorudisha' => $this->kiasi_alichorudisha,
            'kiasi_kilichobaki' => $this->kiasi_kilichobaki,
            'tarehe_ya_kufunga' => $this->tarehe_ya_kufunga,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'maelezo_zaid', $this->maelezo_zaid])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'aliyepokea', $this->aliyepokea]);

        return $dataProvider;
    }


    public function searchPending($params)
    {
        $query = MahesabuYaliofungwa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $subquery = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilayas = Wilaya::find()->select('id')->where(['in','mkoa_id',$subquery]);
        $vituo = Vituo::find()->select('id')->where(['in','wilaya_id',$wilayas]);
        $query->where(['status' => MahesabuYaliofungwa::PENDING]);
        $query->andWhere(['in','kituo_id',$vituo]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_ya_kupewa' => $this->tarehe_ya_kupewa,
            'cashier_id' => $this->cashier_id,
            'kituo_id' => $this->kituo_id,
            'kiasi_alichopewa' => $this->kiasi_alichopewa,
            'kiasi_kilichotumika' => $this->kiasi_kilichotumika,
            'kiasi_alichorudisha' => $this->kiasi_alichorudisha,
            'kiasi_kilichobaki' => $this->kiasi_kilichobaki,
            'tarehe_ya_kufunga' => $this->tarehe_ya_kufunga,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'maelezo_zaid', $this->maelezo_zaid])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'aliyepokea', $this->aliyepokea]);

        return $dataProvider;
    }

    public function searchClosed($params)
    {
        $query = MahesabuYaliofungwa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $subquery = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilayas = Wilaya::find()->select('id')->where(['in','mkoa_id',$subquery]);
        $vituo = Vituo::find()->select('id')->where(['in','wilaya_id',$wilayas]);
        $query->where(['status' => MahesabuYaliofungwa::CLOSED]);
       // $query->andWhere(['in','kituo_id',$vituo]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_ya_kupewa' => $this->tarehe_ya_kupewa,
            'cashier_id' => $this->cashier_id,
            'kituo_id' => $this->kituo_id,
            'kiasi_alichopewa' => $this->kiasi_alichopewa,
            'kiasi_kilichotumika' => $this->kiasi_kilichotumika,
            'kiasi_alichorudisha' => $this->kiasi_alichorudisha,
            'kiasi_kilichobaki' => $this->kiasi_kilichobaki,
            'tarehe_ya_kufunga' => $this->tarehe_ya_kufunga,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'maelezo_zaid', $this->maelezo_zaid])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'aliyepokea', $this->aliyepokea]);

        return $dataProvider;
    }
}
