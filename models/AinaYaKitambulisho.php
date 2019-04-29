<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_aina_ya_kitambulisho".
 *
 * @property integer $id
 * @property string $jina
 */
class AinaYaKitambulisho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_aina_ya_kitambulisho';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['jina'], 'string', 'max' => 200],
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
        return ArrayHelper::map(AinaYaKitambulisho::find()->all(),'id' ,'jina');
    }

}
