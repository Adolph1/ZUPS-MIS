<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Audit;

/**
 * AuditSearch represents the model behind the search form about `backend\models\Audit`.
 */
class AuditSearch extends Audit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['activity', 'module', 'action', 'maker', 'maker_time'], 'safe'],
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
        $query = Audit::find();

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
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'maker', $this->maker])
            ->andFilterWhere(['like', 'maker_time', $this->maker_time]);

        return $dataProvider;
    }
}
