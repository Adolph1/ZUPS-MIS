<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_mahitaji_category".
 *
 * @property int $id
 * @property string $jina
 */
class MahitajiCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_mahitaji_category';
    }

    public static function getAll()
    {
        return ArrayHelper::map(MahitajiCategory::find()->all(),'id','jina');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['jina'], 'string', 'max' => 200],
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
        ];
    }
}
