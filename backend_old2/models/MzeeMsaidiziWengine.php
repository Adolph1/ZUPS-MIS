<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_mzee_msaidizi_wengine".
 *
 * @property integer $id
 * @property integer $mzee_id
 * @property integer $mzee_mwingine_id
 * @property integer $power_of_attorney
 * @property integer $status
 * @property string $added_by
 * @property string $valid_date
 * @property string $date_added
 *
 * @property TblMzee $mzee
 * @property TblMzee $mzeeMwingine
 */
class MzeeMsaidiziWengine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    public $my_power;

    public static function tableName()
    {
        return 'tbl_mzee_msaidizi_wengine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mzee_id', 'mzee_mwingine_id', 'status'], 'integer'],
            [['valid_date'], 'string'],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
            [['mzee_mwingine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_mwingine_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mzee_id' => Yii::t('app', 'Mzee ID'),
            'mzee_mwingine_id' => Yii::t('app', 'Mzee Mwingine ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzeee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzeeMwingine()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_mwingine_id']);
    }

}
