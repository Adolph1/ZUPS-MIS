<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_sms_owner".
 *
 * @property integer $id
 * @property string $name
 * @property string $sms_header
 * @property string $sms_content
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblContact[] $tblContacts
 */
class SmsOwner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sms_owner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maker_time'], 'safe'],
            [['name', 'sms_header', 'sms_content', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sms_header' => Yii::t('app', 'Sms Header'),
            'sms_content' => Yii::t('app', 'Sms Content'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblContacts()
    {
        return $this->hasMany(TblContact::className(), ['sms_owner_id' => 'id']);
    }

    //gets all Owners

    public static function getAll()
    {
        return ArrayHelper::map(SmsOwner::find()->all(),'id','name');
    }
}
