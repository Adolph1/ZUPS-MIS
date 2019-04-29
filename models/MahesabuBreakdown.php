<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_mahesabu_breakdown".
 *
 * @property integer $id
 * @property integer $mahesabu_id
 * @property string $kiasi_kilichobaki
 * @property string $tarehe
 *
 * @property TblMahesabuYaliofungwa $mahesabu
 */
class MahesabuBreakdown extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mahesabu_breakdown';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mahesabu_id'], 'integer'],
            [['kiasi_kilichobaki'], 'number'],
            [['tarehe'], 'safe'],
            [['mahesabu_id'], 'exist', 'skipOnError' => true, 'targetClass' => MahesabuYaliofungwa::className(), 'targetAttribute' => ['mahesabu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mahesabu_id' => Yii::t('app', 'Mahesabu ID'),
            'kiasi_kilichobaki' => Yii::t('app', 'Kiasi Kilichobaki'),
            'tarehe' => Yii::t('app', 'Tarehe'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahesabu()
    {
        return $this->hasOne(MahesabuYaliofungwa::className(), ['id' => 'mahesabu_id']);
    }
}
