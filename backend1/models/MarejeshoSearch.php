<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Marejesho;

/**
 * MarejeshoSearch represents the model behind the search form of `backend\models\Marejesho`.
 */
class MarejeshoSearch extends Marejesho
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mahesabu_id'], 'integer'],
            [['tarehe', 'aliyepokea', 'muda_alioingiza'], 'safe'],
            [['kiasi', 'kilichobaki'], 'number'],
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
        $query = Marejesho::find();

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
            'mahesabu_id' => $this->mahesabu_id,
            'kiasi' => $this->kiasi,
            'kilichobaki' => $this->kilichobaki,
            'muda_alioingiza' => $this->muda_alioingiza,
        ]);

        $query->andFilterWhere(['like', 'aliyepokea', $this->aliyepokea]);

        return $dataProvider;
    }
}
