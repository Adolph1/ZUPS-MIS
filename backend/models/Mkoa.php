<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_mkoa".
 *
 * @property integer $id
 * @property string $jina
 * @property integer $zone_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblZone $zone
 * @property TblWilaya[] $tblWilayas
 */
class Mkoa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mkoa';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina', 'zone_id'], 'required'],
            [['zone_id'], 'integer'],
            [['muda'], 'safe'],
            [['jina', 'aliyeweka'], 'string', 'max' => 200],
            [['zone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zone::className(), 'targetAttribute' => ['zone_id' => 'id']],
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
            'zone_id' => Yii::t('app', 'Zone'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZone()
    {
        return $this->hasOne(Zone::className(), ['id' => 'zone_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWilayas()
    {
        return $this->hasMany(Wilaya::className(), ['mkoa_id' => 'id']);
    }


    public static function getAll()
    {
        return ArrayHelper::map(Mkoa::find()->where(['zone_id'=> Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->all(),'id','jina');
    }

    public static function getAllByZoneID($zone_id)
    {
        return ArrayHelper::map(Mkoa::find()->where(['zone_id'=>$zone_id])->all(),'id','jina');
    }

    public static function getRegionBYUSerID($user_id)
    {
        return ArrayHelper::map(Mkoa::find()->where(['id'=>Wafanyakazi::getRegionID($user_id)])->all(),'id','jina');
    }

    public static function getRegionByID($id)
    {
        return ArrayHelper::map(Mkoa::find()->where(['id'=>$id])->all(),'id','jina');
    }

    public static function getZoneByMkoaID($mkoa)
    {
        $mkoa = Mkoa::findOne($mkoa);
    if($mkoa !=  null){
        return $mkoa->zone_id;
    }
    }


    public static function getMikoaByZoneId($id)
    {

    }



}
