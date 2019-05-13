<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MiamalaWatendaji;

/**
 * MiamalaWatendajiSearch represents the model behind the search form about `backend\models\MiamalaWatendaji`.
 */
class MiamalaWatendajiSearch extends MiamalaWatendaji
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cashier_id', 'kituo_id', 'jumla_watendaji', 'status'], 'integer'],
            [['tarehe_ya_kupewa'], 'safe'],
            [['kiasi', 'kiasi_kilicholipwa', 'kiasi_kilichobaki'], 'number'],
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
        $query = MiamalaWatendaji::find();

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
            'tarehe_ya_kupewa' => $this->tarehe_ya_kupewa,
            'cashier_id' => $this->cashier_id,
            'kituo_id' => $this->kituo_id,
            'kiasi' => $this->kiasi,
            'jumla_watendaji' => $this->jumla_watendaji,
            'kiasi_kilicholipwa' => $this->kiasi_kilicholipwa,
            'kiasi_kilichobaki' => $this->kiasi_kilichobaki,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
