<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BidhaaZilizoingia;

/**
 * BidhaaZilizoingiaSearch represents the model behind the search form of `backend\models\BidhaaZilizoingia`.
 */
class BidhaaZilizoingiaSearch extends BidhaaZilizoingia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bidhaa_id'], 'integer'],
            [['tarehe_ya_kuingia', 'jina_aliyeleta', 'aliyepokea', 'aliyeingiza', 'muda'], 'safe'],
            [['idadi', 'jumla'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BidhaaZilizoingia::find();

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
            'tarehe_ya_kuingia' => $this->tarehe_ya_kuingia,
            'bidhaa_id' => $this->bidhaa_id,
            'idadi' => $this->idadi,
            'jumla' => $this->jumla,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'jina_aliyeleta', $this->jina_aliyeleta])
            ->andFilterWhere(['like', 'aliyepokea', $this->aliyepokea])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
}
