<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_zups_budget_approval".
 *
 * @property int $id
 * @property int $zups_budget_id
 * @property string $maker
 * @property string $stage
 * @property string $muda
 *
 * @property TblZupsBudget $zupsBudget
 */
class ZupsBudgetApproval extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_zups_budget_approval';
    }

    public static function getApprovedBY($status, $id)
    {
        $appoval = ZupsBudgetApproval::findOne(['stage' => $status,'zups_budget_id' => $id]);
        if($appoval != null){
            return $appoval->maker;
        }else{
            return '';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['zups_budget_id'], 'integer'],
            [['muda'], 'safe'],
            [['maker', 'stage'], 'string', 'max' => 200],
            [['zups_budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => ZupsBudget::className(), 'targetAttribute' => ['zups_budget_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zups_budget_id' => 'Zups Budget ID',
            'maker' => 'Maker',
            'stage' => 'Stage',
            'muda' => 'Muda',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZupsBudget()
    {
        return $this->hasOne(ZupsBudget::className(), ['id' => 'zups_budget_id']);
    }
}
