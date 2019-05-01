<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UhakikiForm;

/**
 * UhakikiFormSearch represents the model behind the search form about `backend\models\UhakikiForm`.
 */
class UhakikiFormSearch extends UhakikiForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mzee_id'], 'integer'],
            [['tarehe_ya_uhakiki', 'aliyemhakiki', 'maoni_ya_uhakiki'], 'safe'],
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
        $query = UhakikiForm::find();

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
            'tarehe_ya_uhakiki' => $this->tarehe_ya_uhakiki,
            'mzee_id' => $this->mzee_id,
        ]);

        $query->andFilterWhere(['like', 'aliyemhakiki', $this->aliyemhakiki])
            ->andFilterWhere(['like', 'maoni_ya_uhakiki', $this->maoni_ya_uhakiki]);

        return $dataProvider;
    }


    public function searchByMzeeId($id)
    {
        $query = UhakikiForm::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
        ]);
        $query->where(['mzee_id' => $id]);

        //$query->orderBy(['siku_kwanza' => SORT_DESC]);


        return $dataProvider;
    }
}
