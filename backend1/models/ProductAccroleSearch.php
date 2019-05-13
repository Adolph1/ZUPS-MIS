<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProductAccrole;

/**
 * ProductAccroleSearch represents the model behind the search form about `backend\models\ProductAccrole`.
 */
class ProductAccroleSearch extends ProductAccrole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_role', 'product_code', 'role_type', 'status', 'account_head', 'description'], 'safe'],
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
        $query = ProductAccrole::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'account_role', $this->account_role])
            ->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'role_type', $this->role_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'account_head', $this->account_head])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
    public function searchrole($params)
    {
        $query = ProductAccrole::find();
              //->where('product_code = :product_code')
             // ->addParams([':product_code' => $params])
             // ->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
       ]);

        //if (!($this->load($params) && $this->validate())) {
           //return $dataProvider;
        //}
        $query->andFilterWhere([
            'product_code' => $params,
        ]);

        //$query->andFilterWhere(['like', 'product_code', $params]);


        return $dataProvider;
    }

}
