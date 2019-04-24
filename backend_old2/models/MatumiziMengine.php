<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_matumizi_mengine".
 *
 * @property integer $id
 * @property integer $idadi
 * @property string $tarehe
 * @property string $budget_id
 * @property integer $aina_ya_matumizi
 * @property string $kiasi
 * @property string $stakabadhi
 * @property string $aliyetumia
 * @property string $malezo
 * @property string $aliyeweka
 * @property string $muda
 * @property string $status
 * @property string $kumbukumbu_no
 */
class MatumiziMengine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    const PENDING = 0;
    const RECEIVED = 1;
    public $stakabadhi_ya_malipo;
    public $date1;
    public $date2;

    public static function tableName()
    {
        return 'tbl_matumizi_mengine';
    }

    public static function getTotalPaid($budgetId)
    {
        $sum = MatumiziMengine::find()->where(['budget_id' => $budgetId])->sum('kiasi');
        if($sum != null){
            return $sum;
        }else{
            return 0;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarehe','idadi','aina_ya_matumizi','kiasi'], 'required'],
            [['tarehe', 'muda',], 'safe'],
            [['aina_ya_matumizi','idadi','supplier_id'], 'integer'],
            [['kiasi'], 'number'],
            [['stakabadhi', 'aliyetumia', 'malezo', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarehe' => 'Tarehe',
            'aina_ya_matumizi' => 'Aina Ya Matumizi',
            'budget_idadi' => 'Idadi katika Budget',
            'bei' => 'Kiasi kwa moja/mmoja ',
            'supplier_id' => 'Supplier',
            'kiasi' => 'Jumla ya fedha',
            'stakabadhi' => 'Stakabadhi',
            'aliyetumia' => 'Aliyetumia',
            'malezo' => 'Malezo',
            'aliyeweka' => 'Aliyeweka',
            'muda' => 'Muda',
        ];
    }

    public static function getPaidByBudgetId()
    {
        $budgetId = Budget::getLatestBudget();
        if($budgetId != null){
            return MatumiziMengine::find()->where(['budget_id' => $budgetId])->sum('kiasi');
        }else{
            return null;
        }
    }



    public function getAina()
    {
        return $this->hasOne(Mahitaji::className(), ['id' => 'aina_ya_matumizi']);
    }

    public function getCashier()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'aliyetumia']);
    }

    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }
}
