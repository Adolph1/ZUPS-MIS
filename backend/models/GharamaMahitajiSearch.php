<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GharamaMahitaji;

/**
 * GharamaMahitajiSearch represents the model behind the search form about `backend\models\GharamaMahitaji`.
 */
class GharamaMahitajiSearch extends GharamaMahitaji
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'budget_id', 'hitaji_id', 'wilaya_id','status', 'idadi_ya_siku', 'idadi_ya_vitu'], 'integer'],
            [['gharama', 'total'], 'number'],
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
        $query = GharamaMahitaji::find();

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
            'budget_id' => $this->budget_id,
            'hitaji_id' => $this->hitaji_id,
            'wilaya_id' => $this->wilaya_id,
            'idadi_ya_siku' => $this->idadi_ya_siku,
            'idadi_ya_vitu' => $this->idadi_ya_vitu,
            'gharama' => $this->gharama,
            'total' => $this->total,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function searchBYBudgetID($id)
    {

        $query = GharamaMahitaji::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['budget_id' => $id]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        return $dataProvider;
    }
}
