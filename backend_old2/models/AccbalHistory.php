<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_accbal_history".
 *
 * @property integer $id
 * @property string $branch_code
 * @property string $account
 * @property string $bkg_date
 * @property string $acy_opening_balance
 * @property string $acy_closing_balance
 * @property string $acy_dr_tur
 * @property string $acy_cr_tur
 * @property string $available_closing
 * @property string $acy_closing_uncoll
 */
class AccbalHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_accbal_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_code', 'account', 'bkg_date', 'acy_opening_balance', 'acy_closing_balance', 'acy_dr_tur', 'acy_cr_tur', 'available_closing', 'acy_closing_uncoll'], 'required'],
            [['bkg_date'], 'safe'],
            [['acy_opening_balance', 'acy_closing_balance', 'acy_dr_tur', 'acy_cr_tur', 'available_closing', 'acy_closing_uncoll'], 'number'],
            [['branch_code', 'account'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branch_code' => Yii::t('app', 'Branch Code'),
            'account' => Yii::t('app', 'Account'),
            'bkg_date' => Yii::t('app', 'Bkg Date'),
            'acy_opening_balance' => Yii::t('app', 'Acy Opening Balance'),
            'acy_closing_balance' => Yii::t('app', 'Acy Closing Balance'),
            'acy_dr_tur' => Yii::t('app', 'Acy Dr Tur'),
            'acy_cr_tur' => Yii::t('app', 'Acy Cr Tur'),
            'available_closing' => Yii::t('app', 'Available Closing'),
            'acy_closing_uncoll' => Yii::t('app', 'Acy Closing Uncoll'),
        ];
    }
}
