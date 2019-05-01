<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_miamala_fedha".
 *
 * @property integer $id
 * @property string $tarehe_muamala
 * @property string $kiasi
 * @property string $aina_ya_muamala
 * @property integer $mfanyakazi_id
 * @property string $maelezo
 * @property string $status
 * @property string $aliyeweka
 * @property string $muda
 */
class MiamalaFedha extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_miamala_fedha';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarehe_muamala', 'kiasi', 'aina_ya_muamala'], 'required'],
            [['tarehe_muamala', 'muda'], 'safe'],
            [['kiasi'], 'number'],
            [['mfanyakazi_id'], 'integer'],
            [['aina_ya_muamala', 'status'], 'string', 'max' => 1],
            [['maelezo', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tarehe_muamala' => Yii::t('app', 'Tarehe Muamala'),
            'kiasi' => Yii::t('app', 'Kiasi'),
            'aina_ya_muamala' => Yii::t('app', 'Aina Ya Muamala'),
            'mfanyakazi_id' => Yii::t('app', 'Mfanyakazi'),
            'maelezo' => Yii::t('app', 'Maelezo'),
            'status' => Yii::t('app', 'Status'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    public function getMfanyakazi()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'mfanyakazi_id']);
    }

}
