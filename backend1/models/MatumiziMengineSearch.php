<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MatumiziMengine;

/**
 * MatumiziMengineSearch represents the model behind the search form about `backend\models\MatumiziMengine`.
 */
class MatumiziMengineSearch extends MatumiziMengine
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aina_ya_matumizi'], 'integer'],
            [['tarehe', 'stakabadhi', 'aliyetumia', 'malezo', 'aliyeweka', 'muda','date1','date2'], 'safe'],
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
        $query = MatumiziMengine::find();

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
            'tarehe' => $this->tarehe,
            'aina_ya_matumizi' => $this->aina_ya_matumizi,
            'kiasi' => $this->kiasi,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'stakabadhi', $this->stakabadhi])
            ->andFilterWhere(['like', 'aliyetumia', $this->aliyetumia])
            ->andFilterWhere(['like', 'malezo', $this->malezo])
            ->andFilterWhere(['between', 'tarehe', $this->date1, $this->date2])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function searchOrdered($params)
    {
        $query = MatumiziMengine::find();
        $query->where(['status' => MatumiziMengine::PENDING]);

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
            'tarehe' => $this->tarehe,
            'aina_ya_matumizi' => $this->aina_ya_matumizi,
            'kiasi' => $this->kiasi,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'stakabadhi', $this->stakabadhi])
            ->andFilterWhere(['like', 'aliyetumia', $this->aliyetumia])
            ->andFilterWhere(['like', 'malezo', $this->malezo])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
