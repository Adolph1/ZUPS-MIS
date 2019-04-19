<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FundBudget;

/**
 * FundBudgetSearch represents the model behind the search form of `backend\models\FundBudget`.
 */
class FundBudgetSearch extends FundBudget
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'budget_id'], 'integer'],
            [['wazee', 'uendeshaji', 'jumla', 'kiasi_kilichotolewa', 'bakaa'], 'number'],
            [['aliyeingiza', 'muda'], 'safe'],
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
        $query = FundBudget::find();
        $zoneBudgets = Budget::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $query->where(['in','budget_id',$zoneBudgets]);
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
            'wazee' => $this->wazee,
            'uendeshaji' => $this->uendeshaji,
            'jumla' => $this->jumla,
            'kiasi_kilichotolewa' => $this->kiasi_kilichotolewa,
            'bakaa' => $this->bakaa,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
}
