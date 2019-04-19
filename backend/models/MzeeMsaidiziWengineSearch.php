<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MzeeMsaidiziWengine;

/**
 * MzeeMsaidiziWengineSearch represents the model behind the search form about `backend\models\MzeeMsaidiziWengine`.
 */
class MzeeMsaidiziWengineSearch extends MzeeMsaidiziWengine
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mzee_id', 'mzee_mwingine_id', 'status'], 'integer'],
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
        $query = MzeeMsaidiziWengine::find();

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
            'mzee_mwingine_id' => $this->mzee_mwingine_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }

    public function searchByMsaidizId($id)
    {
        $query = MzeeMsaidiziWengine::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['mzee_id' => $id,'status' => 1]);


        // grid filtering conditions


        return $dataProvider;

    }
}
