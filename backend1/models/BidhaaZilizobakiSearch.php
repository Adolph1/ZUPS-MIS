<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BidhaaZilizobaki;

/**
 * BidhaaZilizobakiSearch represents the model behind the search form of `backend\models\BidhaaZilizobaki`.
 */
class BidhaaZilizobakiSearch extends BidhaaZilizobaki
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bidhaa_id'], 'integer'],
            [['idadi'], 'number'],
            [['aliyeingiza', 'muda'], 'safe'],
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
        $query = BidhaaZilizobaki::find();

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
            'bidhaa_id' => $this->bidhaa_id,
            'idadi' => $this->idadi,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
}
