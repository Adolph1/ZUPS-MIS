<?php

namespace backend\models;

use Yii;
use backend\models\SystemModule;


/**
 * This is the model class for table "tbl_report".
 *
 * @property integer $id
 * @property string $report_name
 * @property integer $module
 * @property string $path
 * @property integer $status
 */
class Report extends \yii\db\ActiveRecord
{

    const JANUARARI = 1;
    const FEBRUARI = 2;
    const MACHI = 3;
    const APRILI = 4;
    const MEI = 5;
    const JUNI = 6;
    const JULAI = 7;
    const AGOSTI = 8;
    const SEPTEMBA = 9;
    const OKTOBA = 10;
    const NOVEMBA = 11;
    const DISEMBA = 12;

    public $mwezi;
    public $mwaka;
    public $date1;
    public $date2;
    public $return_amount;
    private $_statusLabel;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_name'], 'required'],
            [['module', 'status'], 'integer'],
            [['report_name', 'path'], 'string', 'max' => 200],
        ];
    }


    /**
     * @inheritdoc
     */
    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }

    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::JANUARARI => Yii::t('app', 'JANUARARI'),
            self::FEBRUARI => Yii::t('app', 'FEBRUARI'),
            self::MACHI => Yii::t('app', 'MACHI'),
            self::APRILI => Yii::t('app', 'APRILI'),
            self::MEI => Yii::t('app', 'MEI'),
            self::JUNI => Yii::t('app', 'JUNI'),
            self::JULAI => Yii::t('app', 'JULAI'),
            self::AGOSTI => Yii::t('app', 'AGOSTI'),
            self::SEPTEMBA => Yii::t('app', 'SEPTEMBA'),
            self::OKTOBA => Yii::t('app', 'OKTOBA'),
            self::NOVEMBA => Yii::t('app', 'NOVEMBA'),
            self::DISEMBA => Yii::t('app', 'DISEMBA'),

        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'report_name' => Yii::t('app', 'Report Name'),
            'module' => Yii::t('app', 'Module'),
            'path' => Yii::t('app', 'Path'),
            'status' => Yii::t('app', 'Status'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleName()
    {
        return $this->hasOne(SystemModule::className(), ['id' => 'module']);
    }
}
