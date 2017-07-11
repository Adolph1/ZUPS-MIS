<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_contact".
 *
 * @property integer $id
 * @property string $phone_number
 * @property string $name
 * @property integer $sms_owner_id
 *
 * @property TblSmsOwner $smsOwner
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sms_owner_id'], 'integer'],
            [['phone_number'], 'string', 'max' => 13],
            [['name'], 'string', 'max' => 200],
            [['sms_owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => SmsOwner::className(), 'targetAttribute' => ['sms_owner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'name' => Yii::t('app', 'Name'),
            'sms_owner_id' => Yii::t('app', 'Sms Owner ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsOwner()
    {
        return $this->hasOne(SmsOwner::className(), ['id' => 'sms_owner_id']);
    }
}
