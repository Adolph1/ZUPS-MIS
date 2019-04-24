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
