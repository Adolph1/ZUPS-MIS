<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Accrole;

/**
 * AccroleSearch represents the model behind the search form about `backend\models\Accrole`.
 */
class AccroleSearch extends Accrole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_code', 'role_description', 'role_type', 'module'], 'safe'],
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
        $query = Accrole::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'role_code', $this->role_code])
            ->andFilterWhere(['like', 'role_description', $this->role_description])
            ->andFilterWhere(['like', 'role_type', $this->role_type])
            ->andFilterWhere(['like', 'module', $this->module]);

        return $dataProvider;
    }
}
