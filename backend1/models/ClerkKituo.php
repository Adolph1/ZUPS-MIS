<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_clerk_kituo".
 *
 * @property integer $id
 * @property integer $kituo_id
 * @property integer $user_id
 * @property string $date_assigned
 * @property integer $status
 * @property string $maker_id
 * @property string $maker_time
 */
class ClerkKituo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_clerk_kituo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kituo_id', 'user_id', 'status'], 'integer'],
            [['date_assigned', 'maker_time'], 'safe'],
            [['maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kituo_id' => Yii::t('app', 'Kituo '),
            'user_id' => Yii::t('app', 'Clerk '),
            'date_assigned' => Yii::t('app', 'Tarehe ya kazi'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Aliyemuingiza '),
            'maker_time' => Yii::t('app', 'Muda '),
        ];
    }


    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }

    public function getCashier()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'user_id']);
    }
}
