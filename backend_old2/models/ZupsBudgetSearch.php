<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ZupsBudget;

/**
 * ZupsBudgetSearch represents the model behind the search form of `backend\models\ZupsBudget`.
 */
class ZupsBudgetSearch extends ZupsBudget
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['mwezi', 'mwaka', 'aliyeingiza', 'muda'], 'safe'],
            [['jumla_iliyoombwa', 'jumla_iliyotolewa', 'bakaa'], 'number'],
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
        $query = ZupsBudget::find();

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
            'jumla_iliyoombwa' => $this->jumla_iliyoombwa,
            'jumla_iliyotolewa' => $this->jumla_iliyotolewa,
            'bakaa' => $this->bakaa,
            'status' => $this->status,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'mwezi', $this->mwezi])
            ->andFilterWhere(['like', 'mwaka', $this->mwaka])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
}
