<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_wazee_waliotenguliwa".
 *
 * @property int $id
 * @property int $mzee_id
 * @property string $sababu
 * @property string $aliyeingiza
 * @property string $muda
 *
 * @property TblMzee $mzee
 */
class WazeeWaliotenguliwa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_wazee_waliotenguliwa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mzee_id', 'sababu'], 'required'],
            [['mzee_id'], 'integer'],
            [['muda'], 'safe'],
            [['sababu', 'aliyeingiza'], 'string', 'max' => 200],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mzee_id' => 'Mzee',
            'sababu' => 'Sababu',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
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
