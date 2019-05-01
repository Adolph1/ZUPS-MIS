<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sheha;

/**
 * ShehaSearch represents the model behind the search form about `backend\models\Sheha`.
 */
class ShehaSearch extends Sheha
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wilaya_id', 'shehia_id'], 'integer'],
            [['jina_kamili', 'mtaa', 'nyumba_namba', 'jinsia', 'simu', 'tarehe_kuzaliwa', 'aliyeweka', 'muda'], 'safe'],
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
        $query = Sheha::find();

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
            'wilaya_id' => $this->wilaya_id,
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'shehia_id' => $this->shehia_id,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
            ->andFilterWhere(['like', 'mtaa', $this->mtaa])
            ->andFilterWhere(['like', 'nyumba_namba', $this->nyumba_namba])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'simu', $this->simu])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
