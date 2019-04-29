<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_product".
 *
 * @property string $product_id
 * @property string $product_descption
 * @property string $product_type
 * @property string $product_module
 * @property string $product_remarks
 * @property string $product_start_date
 * @property string $product_end_date
 * @property string $product_group
 * @property string $maker_id
 * @property string $maker_stamptime
 * @property string $checker_id
 * @property string $checker_stamptime
 * @property string $record_stat
 * @property integer $mod_no
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const FLAT_RATE = 1;
    const REDUCING_BALANCE = 2;

    public $product_detail;

    public static function tableName()
    {
        return 'tbl_product';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_descption', 'product_remarks', 'product_start_date', 'product_group',], 'required'],
            [['mod_no'], 'integer'],
            [['product_id', 'product_descption', 'product_type', 'product_module', 'product_remarks', 'product_start_date', 'product_end_date', 'product_group', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime'], 'string', 'max' => 200],
            [['record_stat'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product Code',
            'product_descption' => 'Product Description',
            'product_type' => 'Product Type',
            'product_module' => 'Product Module',
            'product_remarks' => 'Product Remarks',
            'product_start_date' => 'Product Start Date',
            'product_end_date' => 'Product End Date',
            'product_group' => 'Product Group',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
            'checker_id' => 'Checker ID',
            'checker_stamptime' => 'Checker Stamptime',
            'record_stat' => 'Record Stat',
            'mod_no' => 'Mod No',

        ];
    }




    //gets all Teller products

    public static function getAllTeller()
    {
        return ArrayHelper::map(Product::find()->where(['product_group'=>'Teller'])->all(),'product_id','product_id');
    }

    public static function getAll()
    {
        return ArrayHelper::map(Product::find()->where(['product_group'=>'Fund Transfer'])->all(),'product_id','product_descption');
    }



}
