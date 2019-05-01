<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GeneralLedger;

/**
 * GeneralLedgerSearch represents the model behind the search form about `backend\models\GeneralLedger`.
 */
class GeneralLedgerSearch extends GeneralLedger
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gl_code', 'gl_description', 'parent_gl', 'leaf', 'record_status', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime'], 'safe'],
            [['type', 'customer', 'category', 'posting_restriction', 'mod_no','zone_id'], 'integer'],
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
        $query = GeneralLedger::find();
        $query->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);




        $query->andFilterWhere([
            'type' => $this->type,
            'customer' => $this->customer,
            'category' => $this->category,
            'posting_restriction' => $this->posting_restriction,
            'mod_no' => $this->mod_no,
        ]);

        $query->andFilterWhere(['like', 'gl_code', $this->gl_code])
            ->andFilterWhere(['like', 'gl_description', $this->gl_description])
            ->andFilterWhere(['like', 'parent_gl', $this->parent_gl])
            ->andFilterWhere(['like', 'leaf', $this->leaf])
            ->andFilterWhere(['like', 'record_status', $this->record_status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'maker_stamptime', $this->maker_stamptime])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id])
            ->andFilterWhere(['like', 'checker_stamptime', $this->checker_stamptime]);

        return $dataProvider;
    }
}
