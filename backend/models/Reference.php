<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 5/16/18
 * Time: 3:29 PM
 */

namespace backend\models;

use Yii;

class Reference
{

    public $reference;

    public static function findLast()
    {
        $currentYear = date('Y');
        $budget = Budget::findOne(['kwa_mwaka' => $currentYear]);
        if($budget != null) {
            $model = Budget::find()->all();

            if ($model != null) {
                $reference = 'ZUPS/BGT/' . date('ym') . '/' . sprintf("%04d", count($model) + 1);
                return $reference;
            }
            else {

                $reference = 'ZUPS/BGT/' . date('ym') . '/0001';
                return $reference;

            }
        }else{
            $reference = 'ZUPS/BGT/' . date('ym') . '/0001';
            return $reference;
        }

    }

    public static function findLastVoucher($mwezi,$mwaka)
    {
        $budget = Budget::findOne(['kwa_mwaka' => $mwaka, 'kwa_mwezi' => $mwezi]);
        if($budget != null) {
            $model = Voucher::find()->all();

            if ($model != null) {
                $reference = 'ZUPS/VCH/' . date('ym') . '/' . sprintf("%04d", count($model) + 1);
                return $reference;
            }
            else {

                $reference = 'ZUPS/VCH/' . date('ym') . '/0001';
                return $reference;

            }
        }else{
            $reference = 'ZUPS/VCH/' . date('ym') . '/0001';
            return $reference;
        }
    }

    public static function findLastFund()
    {

        $cashbook = FundBudget::find()->orderBy(['id' => SORT_DESC])->all();
        if($cashbook != null) {

                $reference = 'FBGT'.Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym')  . sprintf("%04d", count($cashbook) + 1);
                return $reference;
            }
            else {

                $reference = 'FBGT'.Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym') . '0001';
                return $reference;

            }
    }

    public static function findLastWatendajiProduct($productcode)
    {
        $product = Product::find()->where(['product_id' => $productcode])->one();
        $payments = MalipoMaafisa::find()->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->orderBy(['id' => SORT_DESC])->all();

        if($payments != null) {

            if($product != null) {
                $reference = $product->product_id. Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym') . sprintf("%04d", count($payments) + 1);
                return $reference;
            }else{
                return '';
            }
        }
        else {
            if($product != null) {
            $reference = $product->product_id.Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym') . '0001';
            return $reference;
            }else{
                return '';
            }
        }
    }

    public static function findLastWatendajiPaid($productcode)
    {
        $product = Product::find()->where(['product_id' => $productcode])->one();
        $payments = MalipoWatendaji::find()->orderBy(['id' => SORT_DESC])->all();

        if($payments != null) {

            if($product != null) {
                $reference = $product->product_id. Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym') . sprintf("%04d", count($payments) + 1);
                return $reference;
            }else{
                return '';
            }
        }
        else {
            if($product != null) {
                $reference = $product->product_id.Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym') . '0001';
                return $reference;
            }else{
                return '';
            }
        }
    }

    public static function getZoneTellerProduct($productcode)
    {
        $product = Product::find()->where(['product_id' => $productcode])->one();
        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);
        $paypoints = Vituo::find()->select('id')->where(['in','wilaya_id',$wilaya]);
        $payments = Teller::find()->where(['in','pay_point_id',$paypoints])->orderBy(['id' => SORT_DESC])->all();

        if($payments != null) {

            if($product != null) {
                $reference = $product->product_id. Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym') . sprintf("%04d", count($payments) + 1);
                return $reference;
            }else{
                return '';
            }
        }
        else {
            if($product != null) {
                $reference = $product->product_id.Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) . date('ym') . '0001';
                return $reference;
            }else{
                return '';
            }
        }
    }

    public static function findBidhaaProduct($productcode)
    {
        $product = Product::find()->where(['product_id' => $productcode])->one();
        $payments = MatumiziMengine::find()->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->orderBy(['id' => SORT_DESC])->all();

        if($payments != null) {

            if($product != null) {
                $reference = $product->product_id. Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) .'MM'. date('ym') . sprintf("%04d", count($payments) + 1);
                return $reference;
            }else{
                return '';
            }
        }
        else {
            if($product != null) {
                $reference = $product->product_id.Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) .'MM'. date('ym') . '0001';
                return $reference;
            }else{
                return '';
            }
        }
    }


}