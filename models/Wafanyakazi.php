<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_wafanyakazi".
 *
 * @property integer $id
 * @property string $jina_kamili
 * @property integer $zone_id
 * @property integer $department_id
 * @property integer $wilaya_id
 * @property integer $kazi_id
 * @property integer $mkoa_id
 * @property integer $report_to
 * @property string $status
 * @property string $aliyeweka
 * @property string $muda
 * @property string $anuani
 * @property string $simu
 *
 * @property TblDepartment $department
 * @property TblKazi $kazi
 * @property TblWilaya $wilaya
 */
class Wafanyakazi extends \yii\db\ActiveRecord
{
    const ACTIVE = 'A';
    const INACTIVE = 'D';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_wafanyakazi';
    }

    public static function getFullnameByUserId($user_id)
    {
        $mfanyakazi = Wafanyakazi::findOne($user_id);
        return $mfanyakazi->jina_kamili;
    }

    public static function getDepartmentID($user_id)
    {
        $mfanyakazi = Wafanyakazi::findOne($user_id);
        return $mfanyakazi->department_id;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'wilaya_id','mkoa_id','zone_id'], 'required'],
            [['department_id', 'wilaya_id', 'kazi_id','mkoa_id','zone_id',], 'integer'],
            [['muda'], 'safe'],
            [['jina_kamili', 'aliyeweka','anuani','simu'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['zone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zone::className(), 'targetAttribute' => ['zone_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['kazi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kazi::className(), 'targetAttribute' => ['kazi_id' => 'id']],
            [['wilaya_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilaya::className(), 'targetAttribute' => ['wilaya_id' => 'id']],
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
            'jina_kamili' => Yii::t('app', 'Jina Kamili'),
            'anuani' => Yii::t('app', 'Anuani'),
            'simu' => Yii::t('app', 'Simu'),
            'zone_id' =>  Yii::t('app', 'Zone'),
            'department_id' => Yii::t('app', 'Idara'),
            'mkoa_id' => Yii::t('app', 'Mkoa '),
            'wilaya_id' => Yii::t('app', 'Wilaya '),
            'kazi_id' => Yii::t('app', 'Kazi '),
            'report_to' => Yii::t('app', 'Cheo'),
            'status' => Yii::t('app', 'Status'),
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
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKazi()
    {
        return $this->hasOne(Kazi::className(), ['id' => 'kazi_id']);
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
    public function getMkoa()
    {
        return $this->hasOne(Mkoa::className(), ['id' => 'mkoa_id']);
    }

    public static function getRegionID($user_id)
    {
        $employee = Wafanyakazi::findOne($user_id);
        if($employee != null){
            return $employee->mkoa_id;
        }
    }

    public static function getDistrictID($user_id)
    {
        $employee = Wafanyakazi::findOne($user_id);
        if($employee != null){
            return $employee->wilaya_id;
        }
    }

    public static function getZoneByID($user_id)
    {
        $mkoa = Wafanyakazi::getRegionID($user_id);
        $zone = Mkoa::getZoneByMkoaID($mkoa);
        if($zone != null){
            return $zone;
        }
    }

    public static function getAll($user_id)
    {
        if(Yii::$app->user->can('admin')) {
            return ArrayHelper::map(Wafanyakazi::find()->all(), 'id', 'jina_kamili');
        }else{
            $zone = Wafanyakazi::getZoneByID($user_id);
            return ArrayHelper::map(Wafanyakazi::find()->where(['in', 'zone_id', $zone])->all(), 'id', 'jina_kamili');
        }
    }

    public static function getCashiers()
    {
        $users = User::find()->select('user_id')->where(['role' => 'Cashier']);
        $accounts = CashierAccount::find()->select('cashier_id');
       // print_r($users);
        //exit;
        return ArrayHelper::map(Wafanyakazi::find()->where(['in','id',$users])->andWhere(['not in','id',$accounts])->all(),'id','jina_kamili');
    }

}
