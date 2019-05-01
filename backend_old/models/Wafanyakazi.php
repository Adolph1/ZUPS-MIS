<?php

namespace backend\models;

use Yii;

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
 *
 * @property TblDepartment $department
 * @property TblKazi $kazi
 * @property TblWilaya $wilaya
 */
class Wafanyakazi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_wafanyakazi';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'wilaya_id', 'kazi_id','mkoa_id','zone_id'], 'required'],
            [['department_id', 'wilaya_id', 'kazi_id','mkoa_id','zone_id'], 'integer'],
            [['muda'], 'safe'],
            [['jina_kamili', 'aliyeweka'], 'string', 'max' => 200],
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
            'zone_id' =>  Yii::t('app', 'Zone'),
            'department_id' => Yii::t('app', 'Department'),
            'mkoa_id' => Yii::t('app', 'Mkoa '),
            'wilaya_id' => Yii::t('app', 'Wilaya '),
            'kazi_id' => Yii::t('app', 'Kitengo '),
            'report_to' => Yii::t('app', 'Report To'),
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
}
