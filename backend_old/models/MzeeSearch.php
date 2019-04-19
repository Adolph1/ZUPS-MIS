<?php

namespace backend\models;

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
    public function rules()
    {
        return [
            [['id', 'umri_kusajiliwa', 'umri_sasa', 'kazi_id', 'aina_ya_kitambulisho', 'mkoa_id', 'wilaya_id', 'shehia_id', 'posho_wilaya', 'njia_upokeaji', 'jina_bank', 'wanaomtegemea', 'aina_ya_pension', 'status', 'umri_mtu_karibu', 'aina_ya_kitambulisho_mtu_karibu', 'mchukua_taarifa_id'], 'integer'],
            [['fomu_namba', 'picha', 'majina_mwanzo', 'jina_babu', 'jina_maarufu', 'jinsia', 'tarehe_kuzaliwa', 'mzawa_zanzibar', 'nambar', 'tarehe_kuingia_zanzibar', 'simu', 'mtaa', 'namba_nyumba', 'anuani_kamili_mtaa', 'anuani_ya_posta', 'jina_account', 'nambari_account', 'simu_kupokelea', 'pension_nyingine', 'aliyeweka', 'muda', 'anaishi', 'tarehe_kufariki', 'mtu_karibu', 'jinsia_mtu_karibu', 'tarehe_kuzaliwa_mtu_karibu', 'namba_simu', 'picha_mtu_karibu', 'anuani_kamili_mtu_karibu', 'nambari_ya_kitambulisho', 'uhasiano', 'maoni_ofisi_wilaya', 'mzee_finger_print', 'mtu_karibu_finger_print'], 'safe'],
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
            'tarehe_kuzaliwa_mtu_karibu' => $this->tarehe_kuzaliwa_mtu_karibu,
            'umri_mtu_karibu' => $this->umri_mtu_karibu,
            'aina_ya_kitambulisho_mtu_karibu' => $this->aina_ya_kitambulisho_mtu_karibu,
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
            ->andFilterWhere(['like', 'mtu_karibu', $this->mtu_karibu])
            ->andFilterWhere(['like', 'jinsia_mtu_karibu', $this->jinsia_mtu_karibu])
            ->andFilterWhere(['like', 'namba_simu', $this->namba_simu])
            ->andFilterWhere(['like', 'picha_mtu_karibu', $this->picha_mtu_karibu])
            ->andFilterWhere(['like', 'anuani_kamili_mtu_karibu', $this->anuani_kamili_mtu_karibu])
            ->andFilterWhere(['like', 'nambari_ya_kitambulisho', $this->nambari_ya_kitambulisho])
            ->andFilterWhere(['like', 'uhasiano', $this->uhasiano])
            ->andFilterWhere(['like', 'maoni_ofisi_wilaya', $this->maoni_ofisi_wilaya])
            ->andFilterWhere(['like', 'mzee_finger_print', $this->mzee_finger_print])
            ->andFilterWhere(['like', 'mtu_karibu_finger_print', $this->mtu_karibu_finger_print]);

        return $dataProvider;
    }
}
