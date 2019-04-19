<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_gl_daily_balance".
 *
 * @property integer $id
 * @property string $trn_date
 * @property string $gl_code
 * @property string $opening_balance
 * @property string $dr_turn
 * @property string $cr_turn
 * @property string $closing_balance
 */
class GlDailyBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_gl_daily_balance';
    }

    public static function getCurrentBalance($glcode)
    {
        $gl = GlDailyBalance::find()->where(['gl_code' => $glcode])->orderBy(['id' => SORT_DESC])->one();
        if($gl != null){
            return $gl->closing_balance;
            }else{
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_date'], 'safe'],
            [['opening_balance', 'dr_turn', 'cr_turn', 'closing_balance'], 'number'],
            [['gl_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_date' => Yii::t('app', 'Trn Date'),
            'gl_code' => Yii::t('app', 'Gl Code'),
            'opening_balance' => Yii::t('app', 'Opening Balance'),
            'dr_turn' => Yii::t('app', 'Dr Turn'),
            'cr_turn' => Yii::t('app', 'Cr Turn'),
            'closing_balance' => Yii::t('app', 'Closing Balance'),
        ];
    }


    public static function updateGLBalance($glcode,$amount,$drcr)
    {
        //saves gl entry
        $gl=GlDailyBalance::findGLBalance($glcode);

        if($drcr=='C') {
            if ($gl != null) {
                if($gl->trn_date== date('Y-m-d')) {
                    $gl->cr_turn = $gl->cr_turn + $amount;
                    $gl->closing_balance = $gl->opening_balance + $gl->cr_turn - $gl->dr_turn;
                    $gl->save();

                }else{
                    $gl_balance = new GlDailyBalance();
                    $gl_balance->trn_date =  date('Y-m-d');
                    $gl_balance->gl_code = $glcode;
                    $gl_balance->opening_balance = $gl->closing_balance;
                    $gl_balance->dr_turn = 0.00;
                    $gl_balance->cr_turn = $amount;
                    $gl_balance->closing_balance = $gl_balance->opening_balance + $gl_balance->cr_turn-$gl_balance->dr_turn;
                    $gl_balance->save();

                }
            } else {
                $gl_balance = new GlDailyBalance();
                $gl_balance->trn_date =  date('Y-m-d');
                $gl_balance->gl_code = $glcode;
                $gl_balance->opening_balance = 0.00;
                $gl_balance->dr_turn = 0.00;
                $gl_balance->cr_turn = $amount;
                $gl_balance->closing_balance = $gl_balance->opening_balance + $gl_balance->cr_turn-$gl_balance->dr_turn;
                $gl_balance->save();
            }
        }elseif($drcr=='D'){
            if ($gl != null) {
                if($gl->trn_date== date('Y-m-d')) {
                    $gl->dr_turn = $gl->dr_turn + $amount;
                    $gl->closing_balance = $gl->opening_balance + $gl->cr_turn - $gl->dr_turn;
                    $gl->save();

                }else{
                    $gl_balance = new GlDailyBalance();
                    $gl_balance->trn_date =  date('Y-m-d');
                    $gl_balance->gl_code = $glcode;
                    $gl_balance->opening_balance = $gl->closing_balance;
                    $gl_balance->dr_turn = $amount;
                    $gl_balance->cr_turn = 0.00;
                    $gl_balance->closing_balance =   $gl_balance->opening_balance  - $amount;
                    $gl_balance->save();

                }
            } else {
                $gl_balance = new GlDailyBalance();
                $gl_balance->trn_date =  date('Y-m-d');
                $gl_balance->gl_code = $glcode;
                $gl_balance->opening_balance = 0.00;
                $gl_balance->dr_turn = $amount;
                $gl_balance->cr_turn = 0.00;
                $gl_balance->closing_balance = $gl_balance->opening_balance + $gl_balance->cr_turn-$gl_balance->dr_turn;
                $gl_balance->save();
            }
        }
    }


    public static function findGLBalance($id)
    {

        if (($model = GlDailyBalance::find()->where(['gl_code'=>$id])->orderBy(['id'=>SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            return null;
        }

    }
}
