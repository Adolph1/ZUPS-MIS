<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MzeeVipato;

/**
 * MzeeVipatoSearch represents the model behind the search form about `backend\models\MzeeVipato`.
 */
class MzeeVipatoSearch extends MzeeVipato
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mzee_id', 'kipato_id'], 'integer'],
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
        $query = MzeeVipato::find();

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
            'mzee_id' => $this->mzee_id,
            'kipato_id' => $this->kipato_id,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function searchByMzeeId($id)
    {
        $query = MzeeVipato::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->where(['mzee_id' => $id]);



        return $dataProvider;
    }

}
