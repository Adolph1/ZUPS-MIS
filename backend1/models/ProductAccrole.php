<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\ProductEventEntry;

/**
 * This is the model class for table "tbl_product_accrole".
 *
 * @property integer $id
 * @property string $account_role
 * @property string $product_code
 * @property string $role_type
 * @property string $status
 * @property string $account_head
 * @property string $description
 *
 * @property TblGeneralLedger $accountHead
 */
class ProductAccrole extends \yii\db\ActiveRecord
{


    public $accrole;
    public $produtcode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_accrole';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_role', 'product_code', 'status', 'account_head', 'description'], 'required'],
            [['account_role', 'product_code', 'role_type', 'status', 'account_head', 'description'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_role' => 'Account Role',
            'product_code' => 'Product Code',
            'role_type' => 'Role Type',
            'status' => 'Status',
            'account_head' => 'Account Head',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountHead()
    {
        return $this->hasOne(GeneralLedger::className(), ['gl_code' => 'account_head']);
    }

    public static function getGLByProduct($id)
    {
        $glcode=ProductAccrole::find()->where(['product_code'=>$id])->one();
       if($glcode!=null){
           return $glcode->account_head;
       }

    }

    public static function getRoles($productcode, $accrole)
    {
        //return //ProductAccrole::find()
            //->where(['and', "product_code"=>$produtcode, "account_role"=>$accrole])
            //->all();
            return ProductAccrole::findAll(['product_code' => $productcode, 'account_role' => $accrole]);
    }

    //gets roles and events with respect to product code
    public static function getRoleEvents($productcode, $event)
    {
      
               $events=ProductEvententry::find()->where(['product_code'=>$productcode,'event_code'=>$event])->all();
               if($events!=null){
                   return $events;
               }
               else{
                   return '';
               }

    
    }
    public static function getAccountRoleCodeByProductCode($id)
    {
        $role_code=ProductAccrole::find()->where(['product_code'=>$id])->one();
        if($role_code!=null){
            return $role_code->account_role;
        }

    }
    public static function getGlCodeCodeByProductCode($id)
    {
        $role_code=ProductAccrole::find()->where(['product_code'=>$id])->one();
        if($role_code!=null){
            return $role_code->account_head;
        }

    }

    public static function getAll($id)
    {
        return ArrayHelper::map(ProductAccrole::find()->where(['product_code'=>$id])->all(),'account_role','account_role');
    }

    public static function getGLByAccountRole($id)
    {
        $role_code=ProductAccrole::find()->where(['account_role'=>$id])->one();
        if($role_code!=null){
            return $role_code->account_head;
        }
    }

}
