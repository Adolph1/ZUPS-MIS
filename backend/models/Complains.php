<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_complains".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $title
 * @property string $notes
 * @property string $created_date
 * @property string $created_at
 */
class Complains extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_complains';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'email'], 'required'],
            [['notes'], 'string'],
            [['email'], 'email'],
            [['created_date', 'created_at'], 'safe'],
            [['full_name', 'email', 'title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'title' => 'Title',
            'notes' => 'Notes',
            'created_date' => 'Date',
            'created_at' => 'Created At',
        ];
    }
}
