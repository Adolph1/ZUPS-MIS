<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_zups_product".
 *
 * @property integer $id
 * @property integer $miaka
 * @property string $product_code
 * @property string $kiasi
 * @property string $maelezo
 * @property integer $status
 * @property string $aliyeweka
 * @property string $muda
 */
class ZupsProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ACTIVE = 1;
    const INACTIVE = 0;

    public static function tableName()
    {
        return 'tbl_zups_product';
    }

    public static function getArrayStatus()
    {
        return [
            self::ACTIVE => Yii::t('app', 'ACTIVE'),
            self::INACTIVE => Yii::t('app', 'INACTIVE'),

        ];
    }

    public static function getAge($id)
    {
        $pension = ZupsProduct::findOne($id);
        return $pension->miaka;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kiasi', 'maelezo','product_code','miaka'], 'required'],
            [['product_code'], 'unique'],
            [['kiasi'], 'number'],
            [['status','miaka'], 'integer'],
            [['muda'], 'safe'],
            [['product_code'], 'string', 'max' => 4],
            [['maelezo', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_code' => Yii::t('app', 'Code'),
            'kiasi' => Yii::t('app', 'Kiasi'),
            'maelezo' => Yii::t('app', 'Maelezo'),
            'status' => Yii::t('app', 'Status'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }


    public static function getWazeePension($id)
    {
        $pension = ZupsProduct::findOne($id);
        return $pension->kiasi;
    }

    public static function getAll()
    {
        return ArrayHelper::map(ZupsProduct::find()->all(),'id','maelezo');
    }
}
