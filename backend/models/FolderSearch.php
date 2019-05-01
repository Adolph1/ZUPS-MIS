<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Folder;

/**
 * FolderSearch represents the model behind the search form about `backend\models\Folder`.
 */
class FolderSearch extends Folder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id'], 'integer'],
            [['jina', 'aliyeunda', 'muda'], 'safe'],
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
        $query = Folder::find();

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
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'jina', $this->jina])
            ->andFilterWhere(['like', 'aliyeunda', $this->aliyeunda]);

        return $dataProvider;
    }
}
