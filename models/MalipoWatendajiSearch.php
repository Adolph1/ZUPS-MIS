<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MalipoWatendaji;

/**
 * MalipoWatendajiSearch represents the model behind the search form about `backend\models\MalipoWatendaji`.
 */
class MalipoWatendajiSearch extends MalipoWatendaji
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'muamala_id'], 'integer'],
            [['tarehe_ya_kulipwa', 'jina_kamili', 'kazi_yake','date1','date2'], 'safe'],
            [['kiasi_alichopewa'], 'number'],
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
        if(Yii::$app->user->can('Cashier')) {
            $query = MalipoWatendaji::find();
            $subquery = MiamalaWatendaji::find()->select('id')->where(['cashier_id' => Yii::$app->user->identity->user_id]);
            $query->where(['in','muamala_id',$subquery]);
            $query->orderBy(['tarehe_ya_kulipwa' => SORT_DESC]);

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
                'muamala_id' => $this->muamala_id,
                'tarehe_ya_kulipwa' => $this->tarehe_ya_kulipwa,
                'kiasi_alichopewa' => $this->kiasi_alichopewa,
            ]);

            $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
                  ->andFilterWhere(['between', 'tarehe_ya_kulipwa', $this->date1, $this->date2])
                  ->andFilterWhere(['like', 'kazi_yake', $this->kazi_yake]);


            return $dataProvider;
        }else{
            $query = MalipoWatendaji::find();
            $query->orderBy(['tarehe_ya_kulipwa' => SORT_DESC]);

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
                'muamala_id' => $this->muamala_id,
                'tarehe_ya_kulipwa' => $this->tarehe_ya_kulipwa,
                'kiasi_alichopewa' => $this->kiasi_alichopewa,
            ]);

            $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
                ->andFilterWhere(['between', 'tarehe_ya_kulipwa', $this->date1, $this->date2])
                ->andFilterWhere(['like', 'kazi_yake', $this->kazi_yake]);

            return $dataProvider;
        }
    }

    public function searchByMuamalaId($id)
    {
        $query = MalipoWatendaji::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->where(['muamala_id' => $id]);
        $query->andWhere(['!=','status','D']);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        return $dataProvider;
    }
}
