<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_event_type".
 *
 * @property integer $id
 * @property string $event_title
 * @property string $description
 * @property string $status
 */
class EventType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const INIT=1;
    const RVS=2;
    const LQD=3;
    const LDS=4;
    const JN_TO=5;
    const JN_BY=6;


    public static function tableName()
    {
        return 'tbl_event_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_title', 'description'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_title' => Yii::t('app', 'Event Code'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getAll()
    {
        return ArrayHelper::map(EventType::find()->all(),'id','event_title');
    }
}
