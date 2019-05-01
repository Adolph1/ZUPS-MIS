<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AutomationSettings;

/**
 * AutomationSettingsSearch represents the model behind the search form about `backend\models\AutomationSettings`.
 */
class AutomationSettingsSearch extends AutomationSettings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zone_id', 'malipo_kwanza', 'malipo_ya_mwisho', 'mwisho_kuaandaa_voucher', 'muda_wa_voucher'], 'integer'],
            [['aliyeweka', 'muda'], 'safe'],
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
        $query = AutomationSettings::find();

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
            'zone_id' => $this->zone_id,
            'malipo_kwanza' => $this->malipo_kwanza,
            'malipo_ya_mwisho' => $this->malipo_ya_mwisho,
            'mwisho_kuaandaa_voucher' => $this->mwisho_kuaandaa_voucher,
            'muda_wa_voucher' => $this->muda_wa_voucher,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
