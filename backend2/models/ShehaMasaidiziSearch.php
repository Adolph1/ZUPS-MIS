<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ShehaMasaidizi;

/**
 * ShehaMasaidiziSearch represents the model behind the search form about `backend\models\ShehaMasaidizi`.
 */
class ShehaMasaidiziSearch extends ShehaMasaidizi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sheha_id'], 'integer'],
            [['jina_kamili', 'tarehe_kuzaliwa', 'anuani_kamili', 'nambari_ya_simu', 'aliyeweka', 'muda'], 'safe'],
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
        $query = ShehaMasaidizi::find();

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
            'sheha_id' => $this->sheha_id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
            ->andFilterWhere(['like', 'anuani_kamili', $this->anuani_kamili])
            ->andFilterWhere(['like', 'nambari_ya_simu', $this->nambari_ya_simu])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function searchByShahaID($id)
    {
        $query = ShehaMasaidizi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['sheha_id'=>$id]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;

    }
}
