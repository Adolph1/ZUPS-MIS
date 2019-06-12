<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_fund_budget".
 *
 * @property int $id
 * @property int $budget_id
 * @property string $wazee
 * @property string $kumbukumbu_no
 * @property string $uendeshaji
 * @property string $jumla
 * @property string $kiasi_kilichotolewa
 * @property string $bakaa
 * @property string $aliyeingiza
 * @property string $muda
 *
 * @property TblBudget $budget
 */
class FundBudget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_fund_budget';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['budget_id'], 'integer'],
            [['wazee', 'uendeshaji', 'jumla', 'kiasi_kilichotolewa', 'bakaa'], 'number'],
            [['muda'], 'safe'],
            [['aliyeingiza','kumbukumbu_no'], 'string', 'max' => 200],
            [['budget_id'], 'unique'],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'budget_id' => 'Budget',
            'kumbukumbu_no' => 'Kumbukumbu No',
            'wazee' => 'Wazee',
            'uendeshaji' => 'Uendeshaji',
            'jumla' => 'Jumla',
            'kiasi_kilichotolewa' => 'Kiasi Kilichotolewa',
            'bakaa' => 'Bakaa',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
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
