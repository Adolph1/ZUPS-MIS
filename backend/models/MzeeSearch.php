<?php

namespace backend\models;
ini_set('memory_limit','5048M');
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mzee;

/**
 * MzeeSearch represents the model behind the search form about `backend\models\Mzee`.
 */
class MzeeSearch extends Mzee
{
    /**
     * @inheritdoc
     */

    public $tafuta_mzee;

    public function rules()
    {
        return [
            [['id', 'umri_kusajiliwa', 'umri_sasa', 'kazi_id', 'aina_ya_kitambulisho', 'mkoa_id', 'wilaya_id', 'shehia_id','kituo_id', 'posho_wilaya', 'njia_upokeaji', 'jina_bank', 'wanaomtegemea', 'aina_ya_pension', 'status', 'mchukua_taarifa_id'], 'integer'],
            [['fomu_namba', 'picha','tafuta_mzee','mzee_finger_print', 'majina_mwanzo', 'jina_babu', 'jina_maarufu', 'jinsia', 'tarehe_kuzaliwa', 'mzawa_zanzibar', 'nambar', 'tarehe_kuingia_zanzibar', 'simu', 'mtaa', 'namba_nyumba', 'anuani_kamili_mtaa', 'anuani_ya_posta', 'jina_account','aliyechukua_finger','tarehe_ya_finger', 'nambari_account', 'simu_kupokelea', 'pension_nyingine', 'aliyeweka', 'muda', 'anaishi', 'tarehe_kufariki'], 'safe'],
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
        $query = Mzee::find();
       // $query->indexBy('id');
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::ELIGIBLE])->andWhere(['in','mkoa_id',$subquery]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);
      //  $query->orderBy(['shehia_id'=>SORT_ASC]);
      //  $query->asArray()->all();

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
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,

            'kazi_id' => $this->kazi_id,
            'kituo_id' => $this->kituo_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'umri_sasa', $this->umri_sasa])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);
        return $dataProvider;
    }



    public function searchPending($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::PENDING])->andWhere(['in','mkoa_id',$subquery]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;


    }


    public function lineChart()
    {
        $query=Mzee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        if(Yii::$app->user->can('DataClerk')) {
            $pagination = false;
            $query->select(['kituo_id, count(*) AS wazee']);
            $query->groupBy(['kituo_id']);
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $query->Where(['in', 'mkoa_id', $subquery]);
            $query->andWhere(['wilaya_id' => Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)]);
            return $dataProvider;
        }else{
            $pagination = false;
            $query->select(['kituo_id, count(*) AS wazee']);
            $query->groupBy(['kituo_id']);
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $query->Where(['in', 'mkoa_id', $subquery]);
            return $dataProvider;
        }
    }

    public function lineChartWithFinger()
    {
        $query=Mzee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $pagination = false;
        $query->select(['kituo_id, count(*) AS wazee']);
        $query->where(['!=','mzee_finger_print',null]);
        $query->groupBy(['kituo_id']);
        return $dataProvider;
    }

    public function lineAlive()
    {
        $query=Mzee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        if(Yii::$app->user->can('DataClerk')) {
            $pagination = false;
            $query->select(['jinsia,count(*) AS wazee']);
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $query->where(['in', 'mkoa_id', $subquery]);
            $query->andWhere(['!=', 'anaishi', Mzee::DIED]);
            $query->andWhere(['wilaya_id' => Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)]);
            $query->groupBy(['jinsia']);
            return $dataProvider;
        }else{
            $pagination = false;
            $query->select(['jinsia,count(*) AS wazee']);
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $query->where(['in', 'mkoa_id', $subquery]);
            $query->andWhere(['!=', 'anaishi', Mzee::DIED]);
            $query->groupBy(['jinsia']);
            return $dataProvider;
        }
    }
    public function lineAll()
    {
        $query=Mzee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);

        if(Yii::$app->user->can('DataClerk')){
            $pagination = false;
            $query->select(['anaishi,count(*) AS wazee']);
            // $query->where(['!=','anaishi',Mzee::DIED]);
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $query->where(['in', 'mkoa_id', $subquery]);
            $query->andWhere(['wilaya_id' => Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)]);
            $query->groupBy(['anaishi']);

            return $dataProvider;
        }else {

            $pagination = false;
            $query->select(['anaishi,count(*) AS wazee']);
            // $query->where(['!=','anaishi',Mzee::DIED]);
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $query->where(['in', 'mkoa_id', $subquery]);
            $query->groupBy(['anaishi']);

            return $dataProvider;
        }
    }


    public function searchMzeeByDistrictWorker($params)
    {


        $query = Mzee::find();

        // add conditions that should always apply here



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['wilaya_id' =>  Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $this->load($params);
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;
    }

    public function searchRejected($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::REJECTED])->andWhere(['in','mkoa_id',$subquery]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;


    }

    public function searchSuspended($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::SUSPENDED])->andWhere(['in','mkoa_id',$subquery]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;
    }

    public function searchDied($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['anaishi' => Mzee::DIED])->andWhere(['in','mkoa_id',$subquery]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC,'tarehe_kufariki' => SORT_DESC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;
    }

    public function searchVetted($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::VETTED])->andWhere(['in','mkoa_id',$subquery]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;
    }

    public function searchWithFinger($params)
    {

        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->Where(['in','mkoa_id',$subquery]);
        $query->andWhere(['anaishi'=>1]);
        //$query->andWhere(['!=','mzee_finger_print','']);
        $query->orderBy(['tarehe_ya_finger' => SORT_DESC,'majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);
        //$query->groupBy(['wilaya_id','shehia_id']);

        // grid filtering conditions
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'kituo_id' => $this->kituo_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);
        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'muda', $this->muda])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'aliyechukua_finger', $this->aliyechukua_finger])
            ->andFilterWhere(['like', 'tarehe_ya_finger', $this->tarehe_ya_finger])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);



        return $dataProvider;
    }

    public function searchByMsaidizId($queryParams)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['msaidizi_id' => $queryParams]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);


        // grid filtering conditions


        return $dataProvider;

    }

    public function searchPendingMzeeByDistrictWorker($getDistrictID)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);

        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::PENDING])->andWhere(['in','mkoa_id',$subquery]);
        $query->andWhere(['wilaya_id' => $getDistrictID]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;


    }

    public function searchVettedMzeeByDistrictWorker($getDistrictID)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);

        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::VETTED])->andWhere(['in','mkoa_id',$subquery]);
        $query->andWhere(['wilaya_id' => $getDistrictID]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;
    }

    public function searchRejectedBYDistrictOfficer($params)
    {

        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::REJECTED])->andWhere(['in','mkoa_id',$subquery]);
        $query->andWhere(['wilaya_id' =>  Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;


    }

    public function searchSuspendedMzeeByDistrictWorker($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::SUSPENDED])->andWhere(['in','mkoa_id',$subquery]);
        $query->andWhere(['wilaya_id' =>  Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;


    }

    public function searchWithSeventyMzeeByDistrictWorker($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::VETTED])->andWhere(['in','mkoa_id',$subquery]);
        $query->andWhere(['wilaya_id' =>  Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)]);
        $query->andWhere(['>=','umri_sasa',70]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;


    }
    public function searchWithFingerByDistrictWorker($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);

        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->Where(['in','mkoa_id',$subquery]);
        $query->andWhere(['anaishi'=>1]);
        $query->andWhere(['wilaya_id' => $params]);
        //$query->andWhere(['!=','mzee_finger_print','']);
        $query->orderBy(['tarehe_ya_finger' => SORT_DESC,'majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);
        //$query->groupBy(['wilaya_id','shehia_id']);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;
    }

    public function searchWithSeventy($params)
    {
        $query = Mzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $this->load($params);
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['status' => Mzee::VETTED])->andWhere(['in','mkoa_id',$subquery]);
        $query->andWhere(['>=','umri_sasa',70]);
        $query->orderBy(['majina_mwanzo'=> SORT_ASC,'jina_babu'=> SORT_ASC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,
            'umri_sasa' => $this->umri_sasa,
            'kazi_id' => $this->kazi_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);

        return $dataProvider;

    }

    public function searchMzeeShehia($params)
    {
        $query = Mzee::find()->groupBy(['shehia_id']);

        // add conditions that should always apply here
        $query->where(['anaishi'=>1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 300 ],
            'sort'=> ['defaultOrder' => [
                'mkoa_id'=>SORT_ASC,
                'wilaya_id'=>SORT_ASC,
                'shehia_id'=>SORT_ASC,

            ]
            ],

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
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'umri_kusajiliwa' => $this->umri_kusajiliwa,

            'kazi_id' => $this->kazi_id,
            'kituo_id' => $this->kituo_id,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'tarehe_kuingia_zanzibar' => $this->tarehe_kuingia_zanzibar,
            'mkoa_id' => $this->mkoa_id,
            'wilaya_id' => $this->wilaya_id,
            'shehia_id' => $this->shehia_id,
            'posho_wilaya' => $this->posho_wilaya,
            'njia_upokeaji' => $this->njia_upokeaji,
            'jina_bank' => $this->jina_bank,
            'wanaomtegemea' => $this->wanaomtegemea,
            'aina_ya_pension' => $this->aina_ya_pension,
            'muda' => $this->muda,
            'status' => $this->status,
            'tarehe_kufariki' => $this->tarehe_kufariki,
            'mchukua_taarifa_id' => $this->mchukua_taarifa_id,
        ]);

        $query->andFilterWhere(['like', 'fomu_namba', $this->fomu_namba])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'majina_mwanzo', $this->majina_mwanzo])
            ->andFilterWhere(['like', 'jina_babu', $this->jina_babu])
            ->andFilterWhere(['like', 'jina_maarufu', $this->jina_maarufu])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'mzawa_zanzibar', $this->mzawa_zanzibar])
            ->andFilterWhere(['like', 'nambar', $this->nambar])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'namba_nyumba', $this->namba_nyumba])
            ->andFilterWhere(['like', 'anuani_kamili_mtaa', $this->anuani_kamili_mtaa])
            ->andFilterWhere(['like', 'anuani_ya_posta', $this->anuani_ya_posta])
            ->andFilterWhere(['like', 'jina_account', $this->jina_account])
            ->andFilterWhere(['like', 'nambari_account', $this->nambari_account])
            ->andFilterWhere(['like', 'simu_kupokelea', $this->simu_kupokelea])
            ->andFilterWhere(['like', 'pension_nyingine', $this->pension_nyingine])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka])
            ->andFilterWhere(['like', 'anaishi', $this->anaishi])
            ->andFilterWhere(['like', 'umri_sasa', $this->umri_sasa])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print]);
        return $dataProvider;
    }

}
