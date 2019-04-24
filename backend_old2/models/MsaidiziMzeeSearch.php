<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MsaidiziMzee;

/**
 * MsaidiziMzeeSearch represents the model behind the search form about `backend\models\MsaidiziMzee`.
 */
class MsaidiziMzeeSearch extends MsaidiziMzee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mzee_id', 'aina_ya_kitambulisho', 'uhusiano_id', 'status', 'power_status'], 'integer'],
            [['jina_kamili', 'jinsia', 'picha', 'anuani', 'tarehe_kuzaliwa', 'nambari_ya_kitambulisho', 'aliyemuweka', 'power_of_attorney', 'tarehe_mwisho_power', 'finger_print', 'muda'], 'safe'],
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
        $subquery = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->select('msaidizi_id')->where(['in','mkoa_id',$subquery]);
        $query = MsaidiziMzee::find();
        $query->where(['in','id',$wazee]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
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
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'uhusiano_id' => $this->uhusiano_id,
            'status' => $this->status,
            'tarehe_mwisho_power' => $this->tarehe_mwisho_power,
            'power_status' => $this->power_status,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'anuani', $this->anuani])
            ->andFilterWhere(['like', 'nambari_ya_kitambulisho', $this->nambari_ya_kitambulisho])
            ->andFilterWhere(['like', 'aliyemuweka', $this->aliyemuweka])
            ->andFilterWhere(['like', 'power_of_attorney', $this->power_of_attorney])
            ->andFilterWhere(['like', 'finger_print', $this->finger_print]);

        return $dataProvider;
    }

    public function searchByMzeeId($id)
    {
        $query = MsaidiziMzee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['mzee_id' => $id,'status' => MsaidiziMzee::INACTIVE]);
            return $dataProvider;



    }

    public function searchWithFinger($params)
    {
        $subquery = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->select('msaidizi_id')->where(['in','mkoa_id',$subquery])->andWhere(['mzee_finger_print'=>null]);
        $query = MsaidiziMzee::find();
        $query->where(['in','id',$wazee]);
        $query->andWhere(['!=','finger_print','']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'query' => $query,
            'pagination' => [
                'pagesize' => 200 // in case you want a default pagesize
            ]
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
            'tarehe_kuzaliwa' => $this->tarehe_kuzaliwa,
            'aina_ya_kitambulisho' => $this->aina_ya_kitambulisho,
            'uhusiano_id' => $this->uhusiano_id,
            'status' => $this->status,
            'tarehe_mwisho_power' => $this->tarehe_mwisho_power,
            'power_status' => $this->power_status,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'jina_kamili', $this->jina_kamili])
            ->andFilterWhere(['like', 'jinsia', $this->jinsia])
            ->andFilterWhere(['like', 'picha', $this->picha])
            ->andFilterWhere(['like', 'anuani', $this->anuani])
            ->andFilterWhere(['like', 'nambari_ya_kitambulisho', $this->nambari_ya_kitambulisho])
            ->andFilterWhere(['like', 'aliyemuweka', $this->aliyemuweka])
            ->andFilterWhere(['like', 'power_of_attorney', $this->power_of_attorney])
            ->andFilterWhere(['like', 'finger_print', $this->finger_print]);

        return $dataProvider;

    }
}
