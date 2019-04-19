<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_viambatanisho_mzee".
 *
 * @property integer $id
 * @property integer $mzee_id
 * @property integer $aina_id
 * @property string $kiambatanisho
 *
 * @property TblViambatanisho $aina
 * @property TblMzee $mzee
 */
class ViambatanishoMzee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $mzee_kiambatanisho;

    public static function tableName()
    {
        return 'tbl_viambatanisho_mzee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mzee_id', 'aina_id'], 'integer'],
            [['mzee_kiambatanisho'], 'safe'],
            [['kiambatanisho'], 'string', 'max' => 200],
            [['aina_id'], 'exist', 'skipOnError' => true, 'targetClass' => Viambatanisho::className(), 'targetAttribute' => ['aina_id' => 'id']],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mzee_id' => Yii::t('app', 'Mzee '),
            'aina_id' => Yii::t('app', 'Aina '),
            'kiambatanisho' => Yii::t('app', 'Kiambatanisho'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAina()
    {
        return $this->hasOne(Viambatanisho::className(), ['id' => 'aina_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }
}
