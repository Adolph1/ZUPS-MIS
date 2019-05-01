<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KituoShehia;

/**
 * KituoShehiaSearch represents the model behind the search form about `backend\models\KituoShehia`.
 */
class KituoShehiaSearch extends KituoShehia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shehia_id', 'kituo_id'], 'integer'],
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
        $query = KituoShehia::find();

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
            'shehia_id' => $this->shehia_id,
            'kituo_id' => $this->kituo_id,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }

    public function searchAll($params)
    {
        $query = KituoShehia::find();
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $subquery2 = Wilaya::find()->select('id')->where(['in', 'mkoa_id', $subquery]);
        $subquery3 = Shehia::find()->select('id')->where(['in','wilaya_id',$subquery2]);
        $query->Where(['in','shehia_id',$subquery3]);

        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 400 // in case you want a default pagesize
            ]
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
            'shehia_id' => $this->shehia_id,
            'kituo_id' => $this->kituo_id,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
