<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_uhusiano".
 *
 * @property integer $id
 * @property string $jina
 */
class Uhusiano extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_uhusiano';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['jina'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jina' => Yii::t('app', 'Jina'),
        ];
    }

    public static function getAll()
    {
        return ArrayHelper::map(Uhusiano::find()->all(),'id','jina');
    }

}
