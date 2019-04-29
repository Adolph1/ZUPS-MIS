<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_maoni_kwa_mzee".
 *
 * @property integer $id
 * @property integer $mzee_id
 * @property string $sababu
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMzee $mzee
 */
class MaoniKwaMzee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_maoni_kwa_mzee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mzee_id'], 'integer'],
            [['sababu'], 'required'],
            [['sababu'], 'string'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
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
            'mzee_id' => Yii::t('app', 'Mzee ID'),
            'sababu' => Yii::t('app', 'Sababu'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }
}
