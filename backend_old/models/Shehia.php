<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_shehia".
 *
 * @property integer $id
 * @property string $jina
 * @property integer $wilaya_id
 * @property integer $sheha_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMzee[] $tblMzees
 * @property TblSheha $sheha
 * @property TblWilaya $wilaya
 * @property TblVoucher[] $tblVouchers
 */
class Shehia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_shehia';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina', 'wilaya_id', 'sheha_id'], 'required'],
            [['wilaya_id', 'sheha_id'], 'integer'],
            [['muda'], 'safe'],
            [['jina', 'aliyeweka'], 'string', 'max' => 200],
          //  [['sheha_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sheha::className(), 'targetAttribute' => ['sheha_id' => 'id']],
            [['wilaya_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilaya::className(), 'targetAttribute' => ['wilaya_id' => 'id']],
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
            'wilaya_id' => Yii::t('app', 'Wilaya'),
            'sheha_id' => Yii::t('app', 'Sheha'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMzees()
    {
        return $this->hasMany(Mzee::className(), ['shehia_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSheha()
    {
        return $this->hasOne(Sheha::className(), ['id' => 'sheha_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblVouchers()
    {
        return $this->hasMany(Voucher::className(), ['shehia_id' => 'id']);
    }

    public static function getAllByWilayaID($wilaya_id)
    {
        return ArrayHelper::map(Shehia::find()->where(['wilaya_id' => $wilaya_id])->all(),'id','jina');
    }

    public static function getShehiaBYUSerID($user_id)
    {
        return ArrayHelper::map(Shehia::find()->where(['wilaya_id' => Wafanyakazi::getDistrictID($user_id)])->all(),'id','jina');
    }


}
