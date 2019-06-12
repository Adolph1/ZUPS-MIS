<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_budget".
 *
 * @property integer $id
 * @property integer $zone_id
 * @property string $maelezo
 * @property string $kianzio
 * @property string $wazee
 * @property string $uendashaji
 * @property string $jumla_kiasi
 * @property string $kumbukumbu_no
 * @property string $kwa_mwezi
 * @property string $kwa_mwaka
 * @property integer $status
 * @property integer $zups_budget_id
 * @property string $aliyeweka
 * @property string $muda
 * @property string $aliyethitisha
 * @property string $muda_kuthibitisha
 */
class Budget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const OPEN = 0;
    const CLOSED = 1;
    const REVIEWED = 1;
    const APPROVED = 2;
    const REJECTED = 3;
    const WAITING_FUND = 4;
    const FUNDED = 5;
    private $_statusLabel;
    public $date1;
    public $date2;


    public static function tableName()
    {
        return 'tbl_budget';
    }

    public static function getCurrentBudget($getZoneByID)
    {
        $budget = Budget::find()->where(['zone_id' => $getZoneByID])->orderBy(['id' => SORT_DESC])->one();
        if($budget != null){
            return $budget;
        }else{
            return null;
        }
    }

    public static function getLatestBudget()
    {
        $budget = Budget::find()->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->orderBy(['id' => SORT_DESC])->one();
        if($budget != null){
            return $budget;
        }else{
            return null;
        }
    }

    public static function getLastBudget()
    {
        $budget = Budget::find()->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),'status' => Budget::FUNDED])->orderBy(['id' => SORT_DESC])->one();
        if($budget != null){
            return $budget;
        }else{
            return null;
        }
    }

    public static function findOpened()
    {
        $budget = Budget::findOne(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),'status' => Budget::FUNDED]);
        if($budget != null){
            return $budget->status;
        }else{
            return null;
        }
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
            self::OPEN => Yii::t('app', 'IPO WAZI'),
            self::CLOSED => Yii::t('app', 'IMEFUNGWA'),
            self::REJECTED => Yii::t('app', 'IMEKATALIWA'),
            self::WAITING_FUND => Yii::t('app', 'INASUBIRI KULIPWA'),
            self::FUNDED => Yii::t('app', 'IMESHALIPWA'),
        ];
    }

    public static function CurrentBudget()
    {
      $model = Budget::findOne(['status' => 0]);
      if($model != null){
          return $model;
      }
    }

    public static function calculateBudget($bid,$amount)
    {
        $budget = Budget::findOne($bid);
        if($budget != null){
            $budget->jumla_kiasi = $budget->jumla_kiasi + $amount;
            $budget->aliyeweka = Yii::$app->user->identity->username;
            $budget->muda = date('Y-m-d H:i');
            $budget->save();
        }
    }

    public static function getCurrent()
    {
        $budget = Budget::findOne(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),'status' => Budget::FUNDED]);
        if($budget != null){
            return $budget->id;
        }else{
            return null;
        }
    }

    public static function getTotalPerMainBudgetID($id)
    {
        $budgets = Budget::find()->where(['zups_budget_id' => $id])->all();
        $sum = 0;
        if($budgets!=null){
            foreach ($budgets as $budget){
                $sum =$sum + GharamaMahitaji::find()->where(['budget_id' => $budget->id])->sum('total');
            }
        }
        return $sum;
    }

    public static function getMonthlySum($id)
    {
        $budgets = Budget::find()->where(['zups_budget_id' => $id])->all();

        if($budgets!=null){
            $sum = 0;
            foreach ($budgets as $budget){
                $sum =$sum + GharamaMahitaji::find()->where(['budget_id' => $budget->id])->sum('total') + $budget->wazee;
            }
            return $sum;
        }else{
            return 0.00;
        }

    }

    public static function getAll()
    {
        return ArrayHelper::map(Budget::find()->where(['status' => Budget::WAITING_FUND,'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->all(),'id',function($model){
            return $model->kwa_mwezi. '-'. $model->kwa_mwaka;
        });
    }

    public static function getZoneById($budget_id)
    {
        $budget = Budget::findOne($budget_id);
        return $budget->zone_id;
    }


    public static function getClosingBudget()
    {
        $budget = Budget::find()->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->orderBy(['id' => SORT_DESC])->one();
       if($budget->jumla_kiasi != 0.00) {
           return $budget->jumla_kiasi;
       }else{
           return 0.00;
       }

    }

    public static function getWazeeBalance()
    {
        $latest = Budget::getLatestBudget();
        return KituoMonthlyBalances::getBalancePerZone($latest->zone_id,$latest->kwa_mwezi,$latest->kwa_mwaka);
    }

    public static function getWazeePaidBalance()
    {
        $latest = Budget::getLatestBudget();
        return KituoMonthlyBalances::getPaidPerZone($latest->zone_id,$latest->kwa_mwezi,$latest->kwa_mwaka);
    }

    public static function getUendeshajiBalance()
    {
        $latest = Budget::getLatestBudget();
        return $latest->uendeshaji - (MiamalaWatendaji::getTotalPaid($latest->id) + MalipoMaafisa::getTotalPaid($latest->id) + MatumiziMengine::getTotalPaid($latest->id));
    }

    public static function getUendeshajiPaidBalance()
    {
        $latest = Budget::getLatestBudget();
        return MiamalaWatendaji::getTotalPaid($latest->id) + MalipoMaafisa::getTotalPaid($latest->id) + MatumiziMengine::getTotalPaid($latest->id);
    }

    public static function getTotalPaidBalance()
    {

        return Budget::getWazeePaidBalance() + Budget::getUendeshajiPaidBalance();
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kumbukumbu_no','kwa_mwezi','kwa_mwaka'], 'required'],
            [['jumla_kiasi','kianzio','wazee','uendeshaji'], 'number'],
            [['status','zups_budget_id'], 'integer'],
            [['muda', 'muda_kuthibitisha'], 'safe'],
            [['maelezo', 'kumbukumbu_no', 'kwa_mwaka', 'aliyeweka', 'aliyethitisha'], 'string', 'max' => 200],
            [['kwa_mwezi'], 'string', 'max' => 10],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'maelezo' => Yii::t('app', 'Maelezo'),
            'kianzio' => Yii::t('app', 'Kianzio'),
            'wazee' => Yii::t('app', 'Wazee'),
            'uendeshaji' => Yii::t('app', 'Uendeshaji'),
            'jumla_kiasi' => Yii::t('app', 'Jumla'),
            'kumbukumbu_no' => Yii::t('app', 'Kumbukumbu No'),
            'kwa_mwezi' => Yii::t('app', 'Mwezi'),
            'kwa_mwaka' => Yii::t('app', 'Mwaka'),
            'status' => Yii::t('app', 'Status'),
            'aliyeweka' => Yii::t('app', 'Aliyeingiza'),
            'muda' => Yii::t('app', 'Muda'),
            'aliyethitisha' => Yii::t('app', 'Aliyethitisha'),
            'muda_kuthibitisha' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZone()
    {
        return $this->hasOne(Zone::className(), ['id' => 'zone_id']);
    }

    public function getZbudget()
    {
        return $this->hasOne(ZupsBudget::className(), ['id' => 'zups_budget_id']);
    }

}
