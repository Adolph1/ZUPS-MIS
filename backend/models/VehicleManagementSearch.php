<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VehicleManagement;

/**
 * VehicleManagementSearch represents the model behind the search form about `backend\models\VehicleManagement`.
 */
class VehicleManagementSearch extends VehicleManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wilaya_id'], 'integer'],
            [['tarehe_ya_kukodi', 'mmiliki_wa_gari', 'namba_ya_simu_mmiliki', 'aina_ya_gari', 'plate_number', 'jina_la_dereva', 'namba_ya_simu_dereva', 'order_number', 'aliyeingiza', 'muda'], 'safe'],
            [['jumla_ya_fedha_mafuta', 'bei_ya_lita_moja', 'jumla_ya_lita'], 'number'],
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
        $query = VehicleManagement::find();

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
            'tarehe_ya_kukodi' => $this->tarehe_ya_kukodi,
            'wilaya_id' => $this->wilaya_id,
            'jumla_ya_fedha_mafuta' => $this->jumla_ya_fedha_mafuta,
            'bei_ya_lita_moja' => $this->bei_ya_lita_moja,
            'jumla_ya_lita' => $this->jumla_ya_lita,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'mmiliki_wa_gari', $this->mmiliki_wa_gari])
            ->andFilterWhere(['like', 'namba_ya_simu_mmiliki', $this->namba_ya_simu_mmiliki])
            ->andFilterWhere(['like', 'aina_ya_gari', $this->aina_ya_gari])
            ->andFilterWhere(['like', 'plate_number', $this->plate_number])
            ->andFilterWhere(['like', 'jina_la_dereva', $this->jina_la_dereva])
            ->andFilterWhere(['like', 'namba_ya_simu_dereva', $this->namba_ya_simu_dereva])
            ->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
}
