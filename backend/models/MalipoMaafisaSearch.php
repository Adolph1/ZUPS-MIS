<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MalipoMaafisa;

/**
 * MalipoMaafisaSearch represents the model behind the search form about `backend\models\MalipoMaafisa`.
 */
class MalipoMaafisaSearch extends MalipoMaafisa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'budget_id', 'zone_id', 'kituo_id'], 'integer'],
            [['jina_kamili', 'kazi', 'namba_ya_simu', 'tarehe_ya_malipo', 'kumbukumbu_no', 'aliyeingiza', 'muda', 'ofisi_aliyotoka', 'kazi_anayoenda_kufanya','date1','date2'], 'safe'],
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
        $query = MalipoMaafisa::find();
        $query->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);

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
            'budget_id' => $this->budget_id,
            'zone_id' => $this->zone_id,
            'kiasi' => $this->kiasi,
            'tarehe_ya_malipo' => $this->tarehe_ya_malipo,
            'muda' => $this->muda,
            'kituo_id' => $this->kituo_id,
        ]);

        $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
            ->andFilterWhere(['like', 'kazi', $this->kazi])
            ->andFilterWhere(['like', 'namba_ya_simu', $this->namba_ya_simu])
            ->andFilterWhere(['like', 'kumbukumbu_no', $this->kumbukumbu_no])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza])
            ->andFilterWhere(['like', 'ofisi_aliyotoka', $this->ofisi_aliyotoka])
            ->andFilterWhere(['between', 'tarehe_ya_malipo', $this->date1, $this->date2])
            ->andFilterWhere(['like', 'kazi_anayoenda_kufanya', $this->kazi_anayoenda_kufanya]);

        return $dataProvider;
    }
}
