<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\HamishaMzee;

/**
 * HamishaMzeeSearch represents the model behind the search form of `backend\models\HamishaMzee`.
 */
class HamishaMzeeSearch extends HamishaMzee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mzee_id', 'mkoa_anaokwenda', 'wilaya_anayokwenda', 'shehia_anayokwenda', 'mkoa_aliotoka', 'wilaya_aliyotoka', 'shehia_aliyotoka','status'], 'integer'],
            [['sababu', 'tarehe', 'aliyeingiza', 'muda'], 'safe'],
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
    { if (\Yii::$app->user->can('DataClerk')) {
        $query = HamishaMzee::find();

        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(\Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->select('id')->where(['wilaya_id' => Wafanyakazi::getDistrictID(\Yii::$app->user->identity->user_id)]);

        // add conditions that should always apply here
        $query->where(['in', 'mkoa_aliotoka', $mikoa]);

        // add conditions that should always apply here
        $query->andWhere(['in', 'mzee_id', $wazee]);

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
            'mzee_id' => $this->mzee_id,
            'mkoa_anaokwenda' => $this->mkoa_anaokwenda,
            'wilaya_anayokwenda' => $this->wilaya_anayokwenda,
            'shehia_anayokwenda' => $this->shehia_anayokwenda,
            'mkoa_aliotoka' => $this->mkoa_aliotoka,
            'wilaya_aliyotoka' => $this->wilaya_aliyotoka,
            'shehia_aliyotoka' => $this->shehia_aliyotoka,
            'status' => $this->status,
            'tarehe' => $this->tarehe,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'sababu', $this->sababu])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }else{
        $query = HamishaMzee::find();

        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(\Yii::$app->user->identity->user_id)]);


        // add conditions that should always apply here
        $query->where(['in', 'mkoa_aliotoka', $mikoa]);



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
            'mzee_id' => $this->mzee_id,
            'mkoa_anaokwenda' => $this->mkoa_anaokwenda,
            'wilaya_anayokwenda' => $this->wilaya_anayokwenda,
            'shehia_anayokwenda' => $this->shehia_anayokwenda,
            'mkoa_aliotoka' => $this->mkoa_aliotoka,
            'wilaya_aliyotoka' => $this->wilaya_aliyotoka,
            'shehia_aliyotoka' => $this->shehia_aliyotoka,
            'status' => $this->status,
            'tarehe' => $this->tarehe,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'sababu', $this->sababu])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
    }
    public function searchReceived($params)
    {
        if (\Yii::$app->user->can('DataClerk')){
            $query = HamishaMzee::find();
        $wazee = Mzee::find()->select('id')->where(['wilaya_id' => Wafanyakazi::getDistrictID(\Yii::$app->user->identity->user_id)]);

        // add conditions that should always apply here
        $query->where(['in', 'mzee_id', $wazee]);
        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(\Yii::$app->user->identity->user_id)]);

            // add conditions that should always apply here
            $query->andWhere(['in', 'mkoa_anaokwenda', $mikoa]);

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
            'mzee_id' => $this->mzee_id,
            'mkoa_anaokwenda' => $this->mkoa_anaokwenda,
            'wilaya_anayokwenda' => $this->wilaya_anayokwenda,
            'shehia_anayokwenda' => $this->shehia_anayokwenda,
            'mkoa_aliotoka' => $this->mkoa_aliotoka,
            'wilaya_aliyotoka' => $this->wilaya_aliyotoka,
            'shehia_aliyotoka' => $this->shehia_aliyotoka,
            'status' => $this->status,
            'tarehe' => $this->tarehe,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'sababu', $this->sababu])
            ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

        return $dataProvider;
    }
        else {
            $query = HamishaMzee::find();
            $mikoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(\Yii::$app->user->identity->user_id)]);

            // add conditions that should always apply here
            $query->where(['in', 'mkoa_anaokwenda', $mikoa]);

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
                'mzee_id' => $this->mzee_id,
                'mkoa_anaokwenda' => $this->mkoa_anaokwenda,
                'wilaya_anayokwenda' => $this->wilaya_anayokwenda,
                'shehia_anayokwenda' => $this->shehia_anayokwenda,
                'mkoa_aliotoka' => $this->mkoa_aliotoka,
                'wilaya_aliyotoka' => $this->wilaya_aliyotoka,
                'shehia_aliyotoka' => $this->shehia_aliyotoka,
                'status' => $this->status,
                'tarehe' => $this->tarehe,
                'muda' => $this->muda,
            ]);

            $query->andFilterWhere(['like', 'sababu', $this->sababu])
                ->andFilterWhere(['like', 'aliyeingiza', $this->aliyeingiza]);

            return $dataProvider;
        }
    }
}
