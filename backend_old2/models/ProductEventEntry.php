<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_product_event_entry".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $transaction_code
 * @property string $dr_cr_indicator
 * @property string $event_code
 * @property string $account_role_code
 * @property string $role_type
 * @property string $mis_head
 */
class ProductEventEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_event_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'dr_cr_indicator', 'event_code', 'account_role_code',], 'required'],
            [['product_code', 'transaction_code', 'dr_cr_indicator', 'event_code', 'account_role_code', 'role_type', 'mis_head'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'transaction_code' => 'Transaction Code',
            'dr_cr_indicator' => 'Dr / Cr Indicator',
            'event_code' => 'Event Code',
            'account_role_code' => 'Account Role Code',
            'role_type' => 'Role Type',
            'mis_head' => 'Mis Head',
        ];
    }

    public static function getGLRole($id)
    {
        $gl=ProductAccrole::getGLByAccountRole($id);
        if($gl!=null){
            return $gl;
        }
    }

    public function getEventCode()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_code']);
    }
}
