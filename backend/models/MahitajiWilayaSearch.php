<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MahitajiWilaya;

/**
 * MahitajiWilayaSearch represents the model behind the search form about `backend\models\MahitajiWilaya`.
 */
class MahitajiWilayaSearch extends MahitajiWilaya
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wilaya_id', 'hitaji_id'], 'integer'],
            [['aliyeweka', 'muda'], 'safe'],
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
        $query = MahitajiWilaya::find();

        // add conditions that should always apply here
        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->where(['in','wilaya_id',$wilaya]);
        $query->groupBy(['wilaya_id']);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'wilaya_id' => $this->wilaya_id,
            'hitaji_id' => $this->hitaji_id,
            'muda' => $this->muda,
        ]);

        $query->andFilterWhere(['like', 'aliyeweka', $this->aliyeweka]);

        return $dataProvider;
    }
}
