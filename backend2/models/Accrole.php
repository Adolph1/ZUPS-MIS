<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_accrole".
 *
 * @property string $role_code
 * @property string $role_description
 * @property string $role_type
 * @property string $module
 */
class Accrole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_accrole';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_code', 'role_description', 'role_type', 'module'], 'required'],
            [['role_code', 'role_description', 'role_type', 'module'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_code' => 'Role Code',
            'role_description' => 'Role Description',
            'role_type' => 'Role Type',
            'module' => 'Module',
        ];
    }
}
