<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_msadizi_wazee_wengine".
 *
 * @property integer $id
 * @property integer $msaidizi_id
 * @property integer $mzee_id
 * @property integer $status
 * @property string $power_of_attorney
 * @property string $valid_date
 *
 * @property TblMsaidiziMzee $msaidizi
 */
class MsadiziWazeeWengine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $my_power;

    public static function tableName()
    {
        return 'tbl_msadizi_wazee_wengine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msaidizi_id', 'mzee_id', 'status'], 'integer'],
            [['valid_date'], 'required'],
            [['msaidizi_id'], 'exist', 'skipOnError' => true, 'targetClass' => MsaidiziMzee::className(), 'targetAttribute' => ['msaidizi_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'msaidizi_id' => Yii::t('app', 'Msaidizi ID'),
            'mzee_id' => Yii::t('app', 'Mzee ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMsaidizi()
    {
        return $this->hasOne(MsaidiziMzee::className(), ['id' => 'msaidizi_id']);
    }

    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }
}
