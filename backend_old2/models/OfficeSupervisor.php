<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_office_supervisor".
 *
 * @property integer $id
 * @property integer $aina_id
 * @property string $kiasi
 * @property string $maelezo
 * @property integer $budget_id
 * @property string $kiambatanisho
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblAinaYaMatumizi $aina
 * @property TblBudget $budget
 */
class OfficeSupervisor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $budget_number;
    public static function tableName()
    {
        return 'tbl_office_supervisor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aina_id', 'kiasi', 'maelezo', 'budget_id'], 'required'],
            [['aina_id', 'budget_id'], 'integer'],
            [['kiasi'], 'number'],
            [['muda'], 'safe'],
            [['maelezo', 'kiambatanisho', 'aliyeweka'], 'string', 'max' => 200],
            [['aina_id'], 'exist', 'skipOnError' => true, 'targetClass' => AinaYaMatumizi::className(), 'targetAttribute' => ['aina_id' => 'id']],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'aina_id' => Yii::t('app', 'Aina'),
            'kiasi' => Yii::t('app', 'Kiasi'),
            'maelezo' => Yii::t('app', 'Maelezo'),
            'budget_id' => Yii::t('app', 'Budget namba'),
            'kiambatanisho' => Yii::t('app', 'Kiambatanisho'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAina()
    {
        return $this->hasOne(AinaYaMatumizi::className(), ['id' => 'aina_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
    }
}
