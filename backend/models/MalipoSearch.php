<?php

namespace backend\models;
ini_set('memory_limit','2048M');

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Malipo;

/**
 * MalipoSearch represents the model behind the search form about `backend\models\Malipo`.
 */
class MalipoSearch extends Malipo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'voucher_id', 'shehia_id', 'mzee_id', 'kituo_id', 'status', 'aliyelipwa'], 'integer'],
            [['siku_kwanza', 'siku_pili', 'siku_mwisho', 'tarehe_kulipwa', 'cashier_id', 'device_number', 'muda'], 'safe'],
            [['kiasi'], 'number'],
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
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $currentMonth = date('m');
        $previusOne = $currentMonth - 1;
        $previusTwo = $previusOne - 1;

        $subquery=Voucher::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in','mwezi',[$currentMonth,$previusOne,$previusTwo]]);
        $query->where(['in','voucher_id',$subquery]);
        $query->andWhere(['status' => Malipo::PENDING]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'siku_kwanza' => $this->siku_kwanza,
            'siku_pili' => $this->siku_pili,
            'siku_mwisho' => $this->siku_mwisho,
            'shehia_id' => $this->shehia_id,
            'mzee_id' => $this->mzee_id,
            'kiasi' => $this->kiasi,
            'tarehe_kulipwa' => $this->tarehe_kulipwa,
            'kituo_id' => $this->kituo_id,
            'status' => $this->status,
            'aliyelipwa' => $this->aliyelipwa,
            'muda' => $this->muda,
        ]);
        $query->orderBy(['siku_kwanza' => SORT_DESC]);

        $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
            ->andFilterWhere(['like', 'device_number', $this->device_number]);

        return $dataProvider;
    }

    public function searchAll($params)
    {
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);

        $subquery=Voucher::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['in','voucher_id',$subquery]);
        $query->andWhere(['status' => Malipo::PENDING]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'siku_kwanza' => $this->siku_kwanza,
            'siku_pili' => $this->siku_pili,
            'siku_mwisho' => $this->siku_mwisho,
            'shehia_id' => $this->shehia_id,
            'mzee_id' => $this->mzee_id,
            'kiasi' => $this->kiasi,
            'tarehe_kulipwa' => $this->tarehe_kulipwa,
            'kituo_id' => $this->kituo_id,
            'status' => $this->status,
            'aliyelipwa' => $this->aliyelipwa,
            'muda' => $this->muda,
        ]);
        $query->orderBy(['siku_kwanza' => SORT_DESC]);

        $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
            ->andFilterWhere(['like', 'device_number', $this->device_number]);

        return $dataProvider;
    }

    public function searchSummary($params)
    {
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $currentMonth = date('m');


        $subquery=Voucher::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in','mwezi',[$currentMonth]]);
        $query->where(['in','voucher_id',$subquery]);
        $query->andWhere(['status' => Malipo::PENDING]);
        $query->groupBy('shehia_id');


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'siku_kwanza' => $this->siku_kwanza,
            'siku_pili' => $this->siku_pili,
            'siku_mwisho' => $this->siku_mwisho,
            'shehia_id' => $this->shehia_id,
            'mzee_id' => $this->mzee_id,
            'kiasi' => $this->kiasi,
            'tarehe_kulipwa' => $this->tarehe_kulipwa,
            'kituo_id' => $this->kituo_id,
            'status' => $this->status,
            'aliyelipwa' => $this->aliyelipwa,
            'muda' => $this->muda,
        ]);
        $query->orderBy(['kituo_id' => SORT_DESC]);


        $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
            ->andFilterWhere(['like', 'device_number', $this->device_number]);

        return $dataProvider;
    }

    public function searchByMzeeId($id)
    {
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['mzee_id' => $id]);

        $query->orderBy(['siku_kwanza' => SORT_DESC]);


        return $dataProvider;
    }

    public function searchByVoucherId($queryParams)
    {
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['voucher_id' =>$queryParams ]);

        $query->orderBy(['siku_kwanza' => SORT_DESC]);


        return $dataProvider;
    }

    public function searchLeo($params)
    {
        if(Yii::$app->user->can('Cashier')) {
            $query = Malipo::find();

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pagesize' => 200 // in case you want a default pagesize
                ]
            ]);

            $currentMonth = date('m');
            $previusOne = $currentMonth - 1;
            $previusTwo = $previusOne - 1;

            $subquery = Voucher::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in', 'mwezi', [$currentMonth, $previusOne, $previusTwo]]);
            $query->where(['in', 'voucher_id', $subquery]);
            $query->andWhere(['status' => Malipo::PAID]);
            $query->andWhere(['cashier_id' => Yii::$app->user->identity->user_id]);
            $query->orderBy(['tarehe_kulipwa' => SORT_DESC]);


            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                'id' => $this->id,
                'voucher_id' => $this->voucher_id,
                'siku_kwanza' => $this->siku_kwanza,
                'siku_pili' => $this->siku_pili,
                'siku_mwisho' => $this->siku_mwisho,
                'shehia_id' => $this->shehia_id,
                'mzee_id' => $this->mzee_id,
                'kiasi' => $this->kiasi,
                'tarehe_kulipwa' => $this->tarehe_kulipwa,
                'kituo_id' => $this->kituo_id,
                'status' => $this->status,
                'aliyelipwa' => $this->aliyelipwa,
                'muda' => $this->muda,
            ]);
            $query->orderBy(['siku_kwanza' => SORT_DESC]);

            $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
                ->andFilterWhere(['like', 'device_number', $this->device_number]);

            return $dataProvider;
        }else{
            $query = Malipo::find();

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pagesize' => 200 // in case you want a default pagesize
                ]
            ]);

            $currentMonth = date('m');
            $previusOne = $currentMonth - 1;
            $previusTwo = $previusOne - 1;

            $subquery = Voucher::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in', 'mwezi', [$currentMonth, $previusOne, $previusTwo]]);
            $query->where(['in', 'voucher_id', $subquery]);
            $query->andWhere(['status' => Malipo::PAID]);
            $query->orderBy(['tarehe_kulipwa' => SORT_DESC]);


            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                'id' => $this->id,
                'voucher_id' => $this->voucher_id,
                'siku_kwanza' => $this->siku_kwanza,
                'siku_pili' => $this->siku_pili,
                'siku_mwisho' => $this->siku_mwisho,
                'shehia_id' => $this->shehia_id,
                'mzee_id' => $this->mzee_id,
                'kiasi' => $this->kiasi,
                'tarehe_kulipwa' => $this->tarehe_kulipwa,
                'kituo_id' => $this->kituo_id,
                'status' => $this->status,
                'aliyelipwa' => $this->aliyelipwa,
                'muda' => $this->muda,
            ]);
            $query->orderBy(['siku_kwanza' => SORT_DESC]);

            $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
                ->andFilterWhere(['like', 'device_number', $this->device_number]);

            return $dataProvider;
        }

    }


    public function lineChart()
    {
        $query=Malipo::find();
        $currentMonth = date('m');
        $previusOne = $currentMonth - 1;
        $previusTwo = $previusOne - 1;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $pagination = false;
        $query->select(['kituo_id, sum(kiasi) AS kiasi']);
        $query->groupBy(['kituo_id']);
        $subquery=Voucher::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in','mwezi',[$currentMonth,$previusOne,$previusTwo]]);
        $query->where(['in','voucher_id',$subquery]);
        //$query->andWhere(['status' => Malipo::PAID]);
        return $dataProvider;
    }

    public function lineQuaterly()
    {
        $query=Malipo::find();
        $currentMonth = date('m');
        $previusOne = $currentMonth - 1;
        $previusTwo = $previusOne - 1;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $pagination = false;
        $query->select(['kituo_id,voucher_id, sum(kiasi) AS kiasi']);
        $query->groupBy(['kituo_id']);
        $subquery=Voucher::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in','mwezi',[$currentMonth,$previusOne,$previusTwo]]);
        $query->where(['in','voucher_id',$subquery]);
        //$query->andWhere(['status' => Malipo::PAID]);
        return $dataProvider;
    }


    public function pieChart()
    {
        $query=Malipo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['kituo_id, sum(kiasi) AS kiasi']);
        $query->groupBy(['kituo_id']);
        return $dataProvider;
    }

    public function searchKiwalaya($params)
    {
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $currentMonth = date('m');


        $subquery=Voucher::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in','mwezi',[$currentMonth]]);
        $query->where(['voucher_id'=>$subquery]);
        $query->groupBy('shehia_id');


        $this->load($params);



        return $dataProvider;
    }

    public function searchExpired($params)
    {

        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);



        $subquery=Voucher::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['in','voucher_id',$subquery]);
        $query->andWhere(['status' => Malipo::EXPIRED]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'siku_kwanza' => $this->siku_kwanza,
            'siku_pili' => $this->siku_pili,
            'siku_mwisho' => $this->siku_mwisho,
            'shehia_id' => $this->shehia_id,
            'mzee_id' => $this->mzee_id,
            'kiasi' => $this->kiasi,
            'tarehe_kulipwa' => $this->tarehe_kulipwa,
            'kituo_id' => $this->kituo_id,
            'status' => $this->status,
            'aliyelipwa' => $this->aliyelipwa,
            'muda' => $this->muda,
        ]);
        $query->orderBy(['siku_kwanza' => SORT_DESC]);

        $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
            ->andFilterWhere(['like', 'device_number', $this->device_number]);

        return $dataProvider;

    }

    public function searchMzeeByDistrictWorker($params)
    {
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $currentMonth = date('m');
        $previusOne = $currentMonth - 1;
        $previusTwo = $previusOne - 1;

        $subquery=Voucher::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), 'mwaka' => date('Y')])->andWhere(['in','mwezi',[$currentMonth,$previusOne,$previusTwo]]);
        $query->where(['in','voucher_id',$subquery]);
        $query->andWhere(['status' => Malipo::PENDING]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'siku_kwanza' => $this->siku_kwanza,
            'siku_pili' => $this->siku_pili,
            'siku_mwisho' => $this->siku_mwisho,
            'shehia_id' => $this->shehia_id,
            'mzee_id' => $this->mzee_id,
            'kiasi' => $this->kiasi,
            'tarehe_kulipwa' => $this->tarehe_kulipwa,
            'kituo_id' => $this->kituo_id,
            'status' => $this->status,
            'aliyelipwa' => $this->aliyelipwa,
            'muda' => $this->muda,
        ]);
        $query->orderBy(['siku_kwanza' => SORT_DESC]);

        $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
            ->andFilterWhere(['like', 'device_number', $this->device_number]);

        return $dataProvider;
    }

    public function searchMyPending($params)
    {
        $query = Malipo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);



            $subquery = Voucher::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $query->where(['in', 'voucher_id', $subquery]);
            $query->andWhere(['status' => Malipo::PENDING]);
            $query->andWhere(['in', 'kituo_id', $params->pay_point_id]);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'siku_kwanza' => $this->siku_kwanza,
            'siku_pili' => $this->siku_pili,
            'siku_mwisho' => $this->siku_mwisho,
            'shehia_id' => $this->shehia_id,
            'mzee_id' => $this->mzee_id,
            'kiasi' => $this->kiasi,
            'tarehe_kulipwa' => $this->tarehe_kulipwa,
            'kituo_id' => $this->kituo_id,
            'status' => $this->status,
            'aliyelipwa' => $this->aliyelipwa,
            'muda' => $this->muda,
        ]);
        $query->orderBy(['siku_kwanza' => SORT_DESC]);

        $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
            ->andFilterWhere(['like', 'device_number', $this->device_number]);

        return $dataProvider;
    }

    public function searchByBudgetId($id)
    {
        $query = Malipo::find();
        $budget = Budget::findOne($id);
        $voucher = Voucher::find()->select('id')->where(['mwezi' => $budget->kwa_mwezi,'mwaka' => $budget->kwa_mwaka,'zone_id' => $budget->zone_id]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['in','voucher_id',$voucher]);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'siku_kwanza' => $this->siku_kwanza,
            'siku_pili' => $this->siku_pili,
            'siku_mwisho' => $this->siku_mwisho,
            'shehia_id' => $this->shehia_id,
            'mzee_id' => $this->mzee_id,
            'kiasi' => $this->kiasi,
            'tarehe_kulipwa' => $this->tarehe_kulipwa,
            'kituo_id' => $this->kituo_id,
            'status' => $this->status,
            'aliyelipwa' => $this->aliyelipwa,
            'muda' => $this->muda,
        ]);
        $query->orderBy(['siku_kwanza' => SORT_DESC]);

        $query->andFilterWhere(['like', 'cashier_id', $this->cashier_id])
            ->andFilterWhere(['like', 'device_number', $this->device_number]);

        return $dataProvider;
    }


}
