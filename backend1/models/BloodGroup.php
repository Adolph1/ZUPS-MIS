<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_blood_group".
 *
 * @property int $id
 * @property string $jina
 * @property string $maelezo
 */
class BloodGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_blood_group';
    }

    public static function getAll()
    {
        return ArrayHelper::map(BloodGroup::find()->all(),'id','jina');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['jina', 'maelezo'], 'string', 'max' => 200],
            [['jina'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jina' => 'Jina',
            'maelezo' => 'Maelezo',
        ];
    }
}
