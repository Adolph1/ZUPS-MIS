<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_product_group".
 *
 * @property integer $group_id
 * @property string $group_name
 */
class ProductGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name'], 'required'],
            [['group_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'group_name' => 'Group Name',
        ];
    }
}
