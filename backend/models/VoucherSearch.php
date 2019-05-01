<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Voucher;

/**
 * VoucherSearch represents the model behind the search form about `backend\models\Voucher`.
 */
class VoucherSearch extends Voucher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zone_id', 'eligible', 'status'], 'integer'],
            [['tarehe_kuandaliwa', 'kumbukumbu_namba', 'mwezi', 'mwaka', 'aliyeandaa', 'muda'], 'safe'],
            [['jumla_fedha', 'jumla_iliyolipwa', 'jumla_iliyobaki'], 'number'],
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
        $query = Voucher::find();
        $query->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),'mwaka' => date('Y')]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->orderBy(['id' => SORT_DESC]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tarehe_kuandaliwa' => $this->tarehe_kuandaliwa,
            'zone_id' => $this->zone_id,
            'eligible' => $this->eligible,
            'jumla_fedha' => $this->jumla_fedha,
            'jumla_iliyolipwa' => $this->jumla_iliyolipwa,
            'jumla_iliyobaki' => $this->jumla_iliyobaki,
            'status' => $this->status,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'kumbukumbu_namba', $this->kumbukumbu_namba])
            ->andFilterWhere(['like', 'mwezi', $this->mwezi])
            ->andFilterWhere(['like', 'mwaka', $this->mwaka])
            ->andFilterWhere(['like', 'aliyeandaa', $this->aliyeandaa]);

        return $dataProvider;
    }
}
