<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Wafanyakazi;

/**
 * WafanyakaziSearch represents the model behind the search form about `backend\models\Wafanyakazi`.
 */
class WafanyakaziSearch extends Wafanyakazi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'wilaya_id', 'kazi_id', 'report_to'], 'integer'],
            [['jina_kamili', 'status', 'aliyeweka', 'muda'], 'safe'],
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
        $query = Wafanyakazi::find();
        $query->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);

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
            'department_id' => $this->department_id,
            'wilaya_id' => $this->wilaya_id,
            'kazi_id' => $this->kazi_id,
            'report_to' => $this->report_to,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
