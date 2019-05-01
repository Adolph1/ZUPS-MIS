<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_njia_malipo".
 *
 * @property integer $id
 * @property string $jina
 */
class NjiaMalipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const CASH = 1;
    const BANK = 2;
    const MOBILE = 3;
    public static function tableName()
    {
        return 'tbl_njia_malipo';
    }
    public static function getAllTypes()
    {
        return [
            self::CASH => Yii::t('app', 'TASLIM'),
            self::BANK => Yii::t('app', 'BENKI'),
            self::MOBILE => Yii::t('app', 'MITANDAO YA SIMU'),
        ];
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
        return ArrayHelper::map(NjiaMalipo::find()->all(),'id','jina');
    }
}
