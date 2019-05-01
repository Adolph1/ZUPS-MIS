<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_wilaya".
 *
 * @property integer $id
 * @property string $jina
 * @property integer $mkoa_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMajimbo[] $tblMajimbos
 * @property TblSheha[] $tblShehas
 * @property TblShehia[] $tblShehias
 * @property TblWafanyakazi[] $tblWafanyakazis
 * @property TblMkoa $mkoa
 */
class Wilaya extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_wilaya';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina', 'mkoa_id'], 'required'],
            [['mkoa_id'], 'integer'],
            [['muda'], 'safe'],
            [['jina', 'aliyeweka'], 'string', 'max' => 200],
            [['mkoa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mkoa::className(), 'targetAttribute' => ['mkoa_id' => 'id']],
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
            'mkoa_id' => Yii::t('app', 'Mkoa '),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMajimbos()
    {
        return $this->hasMany(Majimbo::className(), ['wilaya_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblShehas()
    {
        return $this->hasMany(Sheha::className(), ['wilaya_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblShehias()
    {
        return $this->hasMany(Shehia::className(), ['wilaya_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWafanyakazis()
    {
        return $this->hasMany(Wafanyakazi::className(), ['wilaya_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkoa()
    {
        return $this->hasOne(Mkoa::className(), ['id' => 'mkoa_id']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(Wilaya::find()->all(),'id','jina');
    }

    public static function getAllByRegionID($rgid)
    {
        return ArrayHelper::map(Wilaya::find()->where(['mkoa_id' => $rgid])->all(),'id','jina');
    }

    public static function getDistrictBYUSerID($user_id)
    {
        return ArrayHelper::map(Wilaya::find()->where(['id'=>Wafanyakazi::getDistrictID($user_id)])->all(),'id','jina');
    }

    public static function getDistrictBYID($id)
    {
        return ArrayHelper::map(Wilaya::find()->where(['id' => $id])->all(),'id','jina');
    }
}
