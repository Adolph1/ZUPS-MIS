<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_rejection_reason".
 *
 * @property int $id
 * @property int $zups_budget_id
 * @property string $reason
 * @property string $maker_id
 * @property string $maker_time
 */
class RejectionReason extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_rejection_reason';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reason'], 'required'],
            [['zups_budget_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['reason', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reason' => 'Reason',
            'zups_budget_id' => 'Budget',
            'maker_id' => 'Maker ID',
            'maker_time' => 'Maker Time',
        ];
    }
}
