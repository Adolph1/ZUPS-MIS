<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GlCategory;

/**
 * GlCategorySearch represents the model behind the search form about `backend\models\GlCategory`.
 */
class GlCategorySearch extends GlCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_id'], 'integer'],
            [['category_description', 'category_name', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime'], 'safe'],
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
        $query = GlCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cate_id' => $this->cate_id,
        ]);

        $query->andFilterWhere(['like', 'category_description', $this->category_description])
            ->andFilterWhere(['like', 'category_name', $this->category_name])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'checker_stamptime', $this->checker_stamptime]);

        return $dataProvider;
    }
}
