<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MsadiziWazeeWengine;

/**
 * MsadiziWazeeWengineSearch represents the model behind the search form about `backend\models\MsadiziWazeeWengine`.
 */
class MsadiziWazeeWengineSearch extends MsadiziWazeeWengine
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'msaidizi_id', 'mzee_id', 'status'], 'integer'],
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
        $query = MsadiziWazeeWengine::find();

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
            'msaidizi_id' => $this->msaidizi_id,
            'mzee_id' => $this->mzee_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }

    public function searchByMsaidizId($id)
    {
        $query = MsadiziWazeeWengine::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['msaidizi_id' => $id]);


        // grid filtering conditions


        return $dataProvider;

    }
}
