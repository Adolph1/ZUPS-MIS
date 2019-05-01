<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MiamalaFedha;

/**
 * MiamalaFedhaSearch represents the model behind the search form about `backend\models\MiamalaFedha`.
 */
class MiamalaFedhaSearch extends MiamalaFedha
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mfanyakazi_id'], 'integer'],
            [['tarehe_muamala', 'aina_ya_muamala', 'maelezo', 'status', 'aliyeweka', 'muda'], 'safe'],
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
        $query = MiamalaFedha::find();

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
            'tarehe_muamala' => $this->tarehe_muamala,
            'kiasi' => $this->kiasi,
            'mfanyakazi_id' => $this->mfanyakazi_id,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aina_ya_muamala', $this->aina_ya_muamala])
            ->andFilterWhere(['like', 'maelezo', $this->maelezo])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
