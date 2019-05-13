<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Wilaya;

/**
 * WilayaSearch represents the model behind the search form about `backend\models\Wilaya`.
 */
class WilayaSearch extends Wilaya
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mkoa_id'], 'integer'],
            [['jina', 'aliyeweka', 'muda'], 'safe'],
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
        $query = Wilaya::find();

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
            'mkoa_id' => $this->mkoa_id,
            'muda' => $this->muda,
        ]);
        $subquery = Mkoa::find()->select(['id'])->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->andWhere(['in','mkoa_id',$subquery]);
        $query->andFilterWhere(['like', 'jina', $this->jina])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function searchJana($params)
    {
        $query = Wilaya::find();

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
            'mkoa_id' => $this->mkoa_id,
            'muda' => $this->muda,
        ]);
        $subquery = Mkoa::find()->select(['id'])->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->andWhere(['in','mkoa_id',$subquery]);
        $query->andFilterWhere(['like', 'jina', $this->jina])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function searchJuzi($params)
    {
        $query = Wilaya::find();

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
            'mkoa_id' => $this->mkoa_id,
            'muda' => $this->muda,
        ]);
        $subquery = Mkoa::find()->select(['id'])->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->andWhere(['in','mkoa_id',$subquery]);
        $query->andFilterWhere(['like', 'jina', $this->jina])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function seachMweziLeo()
    {
        $query = Wilaya::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'mkoa_id' => $this->mkoa_id,
            'muda' => $this->muda,
        ]);
        $subquery = Mkoa::find()->select(['id'])->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->andWhere(['in','mkoa_id',$subquery]);
        $query->andFilterWhere(['like', 'jina', $this->jina])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
