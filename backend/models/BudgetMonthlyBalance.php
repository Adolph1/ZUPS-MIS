<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_budget_monthly_balance".
 *
 * @property int $id
 * @property int $budget_id
 * @property string $opening_balance
 * @property string $closing_balance
 * @property string $balance
 * @property string $last_update
 * @property string $updated_by
 */
class BudgetMonthlyBalance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_budget_monthly_balance';
    }

    public static function getLastBalanceByZone($getZoneByID)
    {
        $lastBudget = Budget::find()->where(['zone_id' => $getZoneByID])->orderBy(['id' => SORT_DESC])->one();
        if($lastBudget != null){
            $lastBalance = BudgetMonthlyBalance::find()->where(['budget_id' => $lastBudget->id])->one();
            if($lastBalance != null){
                return $lastBalance->balance;
            }else{
                return 0.00;
            }
        }else{
            return 0.00;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['budget_id'], 'integer'],
            [['opening_balance', 'closing_balance', 'balance'], 'number'],
            [['last_update'], 'safe'],
            [['updated_by'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'budget_id' => 'Bajeti',
            'opening_balance' => 'Kianzio',
            'closing_balance' => 'kufunga usawa',
            'balance' => 'Bakaa',
            'last_update' => 'Last Update',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
    }
}
