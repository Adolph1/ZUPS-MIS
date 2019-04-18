<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_folder".
 *
 * @property integer $id
 * @property string $jina
 * @property integer $department_id
 * @property integer $zone_id
 * @property string $aliyeunda
 * @property string $muda
 * @property string $group
 *
 * @property TblDocument[] $tblDocuments
 * @property TblDepartment $department
 */
class Folder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_folder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['department_id','zone_id'], 'integer'],
            [['muda'], 'safe'],
            [['jina', 'aliyeunda',], 'string', 'max' => 200],
            [['jina'], 'unique'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jina' => 'Jina',
            'department_id' => 'Department',
            //'group' => 'Group',
            'zone_id' => 'Zone',
            'aliyeunda' => 'Aliyeunda',
            'muda' => 'Muda',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDocuments()
    {
        return $this->hasMany(Document::className(), ['folder_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public function getZone()
    {
        return $this->hasOne(Zone::className(), ['id' => 'zone_id']);
    }
}
