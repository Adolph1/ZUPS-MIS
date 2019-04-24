<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_descption', 'product_type', 'product_module', 'product_remarks', 'product_start_date', 'product_end_date', 'product_group', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime', 'record_stat'], 'safe'],
            [['mod_no'], 'integer'],
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'mod_no' => $this->mod_no,
        ]);

        $query->andFilterWhere(['like', 'product_id', $this->product_id])
            ->andFilterWhere(['like', 'product_descption', $this->product_descption])
            ->andFilterWhere(['like', 'product_type', $this->product_type])
            ->andFilterWhere(['like', 'product_module', $this->product_module])
            ->andFilterWhere(['like', 'product_remarks', $this->product_remarks])
            ->andFilterWhere(['like', 'product_start_date', $this->product_start_date])
            ->andFilterWhere(['like', 'product_end_date', $this->product_end_date])
            ->andFilterWhere(['like', 'product_group', $this->product_group])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'checker_stamptime', $this->checker_stamptime])
            ->andFilterWhere(['like', 'record_stat', $this->record_stat]);

        return $dataProvider;
    }
}
