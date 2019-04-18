<?php

namespace backend\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "tbl_msaidizi_mzee".
 *
 * @property integer $id
 * @property string $jina_kamili
 * @property string $jinsia
 * @property integer $mzee_id
 * @property string $picha
 * @property string $anuani
 * @property string $tarehe_kuzaliwa
 * @property integer $aina_ya_kitambulisho
 * @property string $nambari_ya_kitambulisho
 * @property integer $uhusiano_id
 * @property integer $wilaya_id
 * @property integer $mkoa_id
 * @property integer $status
 * @property string $aliyemuweka
 * @property string $power_of_attorney
 * @property string $tarehe_mwisho_power
 * @property string $finger_print
 * @property integer $power_status
 * @property string $muda
 *
 * @property TblMzee $mzee
 */
class MsaidiziMzee extends \yii\db\ActiveRecord
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    const MSAIDIZI = 1;
    const MZEE = 2;
    /**
     * @inheritdoc
     */
    public $msaidizi_picha;
    public $msaidizi_power;

    public static function tableName()
    {
        return 'tbl_msaidizi_mzee';
    }

    public static function calculateDays($tarehe_mwisho_power, $date)
    {

        $diff = strtotime($tarehe_mwisho_power) - strtotime($date);

        $days = $diff / 60 / 60 /24;
        return $days;
    }

    public static function getFullName($msaidizi_id)
    {
        $msaidizi = MsaidiziMzee::findOne($msaidizi_id);
        if($msaidizi != null){
            return $msaidizi->jina_kamili;
        }else{
            return '';
        }
    }

    public static function getFingerPrint($msaidizi_id)
    {
        $msaidizi = MsaidiziMzee::findOne($msaidizi_id);
        if($msaidizi != null){
            if($msaidizi->finger_print != null){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msaidizi_picha'], 'file'],
           // [['msaidizi_picha'], 'file', 'extensions' => 'png,jpg,jepg','maxSize' => 512000, 'tooBig' => 'Limit is 500KB', 'skipOnEmpty' => true,
           //     'checkExtensionByMimeType' => false],
        //    [['nambari_ya_kitambulisho'], 'unique','message'=>'Namba ya kitambulisho imekwisha tumika'],

            [['jina_kamili','wilaya_id','mkoa_id','uhusiano_id','jinsia','aina_ya_kitambulisho','nambari_ya_kitambulisho'], 'required'],
            [['mzee_id', 'aina_ya_kitambulisho', 'uhusiano_id', 'status', 'power_status','mkoa_id','wilaya_id'], 'integer'],
            [['tarehe_kuzaliwa', 'tarehe_mwisho_power', 'muda','msaidizi_picha','msaidizi_power'], 'safe'],
            [['jina_kamili', 'picha', 'anuani', 'nambari_ya_kitambulisho', 'aliyemuweka', 'power_of_attorney', 'finger_print'], 'string', 'max' => 200],
            [['jinsia'], 'string', 'max' => 1],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jina_kamili' => Yii::t('app', 'Jina Kamili'),
            'jinsia' => Yii::t('app', 'Jinsia'),
            'mzee_id' => Yii::t('app', 'Mzee ID'),
            'picha' => Yii::t('app', 'Picha'),
            'anuani' => Yii::t('app', 'Anuani'),
            'wilaya_id' => Yii::t('app', 'Wilaya'),
            'mkoa_id' => Yii::t('app', 'Mkoa'),
            'tarehe_kuzaliwa' => Yii::t('app', 'Tarehe Kuzaliwa'),
            'aina_ya_kitambulisho' => Yii::t('app', 'Aina Ya Kitambulisho'),
            'nambari_ya_kitambulisho' => Yii::t('app', 'Nambari Ya Kitambulisho'),
            'uhusiano_id' => Yii::t('app', 'Uhusiano '),
            'status' => Yii::t('app', 'Status'),
            'aliyemuweka' => Yii::t('app', 'Aliyemuingiza'),
            'power_of_attorney' => Yii::t('app', 'Power Of Attorney'),
            'tarehe_mwisho_power' => Yii::t('app', 'Tarehe ya kuisha power'),
            'finger_print' => Yii::t('app', 'Finger Print'),
            'power_status' => Yii::t('app', 'Power Status'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }
    public function getUhusiano()
    {
        return $this->hasOne(Uhusiano::className(), ['id' => 'uhusiano_id']);
    }
    public function getKitambulisho()
    {
        return $this->hasOne(AinaYaKitambulisho::className(), ['id' => 'aina_ya_kitambulisho']);
    }
}
