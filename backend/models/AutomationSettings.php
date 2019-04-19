<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_automation_settings".
 *
 * @property integer $id
 * @property integer $zone_id
 * @property integer $malipo_kwanza
 * @property integer $malipo_ya_mwisho
 * @property integer $mwisho_kuaandaa_voucher
 * @property integer $muda_wa_voucher
 * @property integer idadi_ya_kuchukulia
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblZone $zone
 */
class AutomationSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_automation_settings';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_id', 'malipo_kwanza', 'malipo_ya_mwisho', 'mwisho_kuaandaa_voucher', 'muda_wa_voucher','idadi_ya_kuchukulia'], 'integer'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
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
            'zone_id' => Yii::t('app', 'Zone '),
            'malipo_kwanza' => Yii::t('app', 'Siku ya malipo ya Kwanza'),
            'malipo_ya_mwisho' => Yii::t('app', 'Siku ya malipo ya Mwisho'),
            'mwisho_kuaandaa_voucher' => Yii::t('app', 'Mwisho Kuaandaa malipo ya wazee'),
            'muda_wa_voucher' => Yii::t('app', 'Muda Wa Voucher kutumika'),
            'idadi_ya_kuchukulia' => Yii::t('app', 'Idadi ya kuchukulia'),
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

    public static function getVoucherDay($zone_id)
    {
    $settings = AutomationSettings::findOne(['zone_id' => $zone_id]);
    if($settings != null){
        return $settings->mwisho_kuaandaa_voucher;
    }
    }

    public static function getDayOne($zone_id)
    {
        $settings = AutomationSettings::findOne(['zone_id' => $zone_id]);
        if($settings != null){
            return $settings->malipo_kwanza;
        }
    }
    public static function getDayTwo($zone_id)
    {
        $settings = AutomationSettings::findOne(['zone_id' => $zone_id]);
        if($settings != null){
            return $settings->malipo_ya_mwisho;
        }
    }
    public static function getDayLast($zone_id)
    {
        $settings = AutomationSettings::findOne(['zone_id' => $zone_id]);
        if($settings != null){
            return $settings->muda_wa_voucher;
        }
    }
    public static function getNextKins($zone_id)
    {
        $settings = AutomationSettings::findOne(['zone_id' => $zone_id]);
        if($settings != null){
            return $settings->idadi_ya_kuchukulia;
        }
    }
}
