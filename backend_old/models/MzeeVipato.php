<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_mzee_vipato".
 *
 * @property integer $id
 * @property integer $mzee_id
 * @property integer $kipato_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblVipato $kipato
 * @property TblMzee $mzee
 */
class MzeeVipato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mzee_vipato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['mzee_id', 'kipato_id'], 'required'],
            [['mzee_id', 'kipato_id'], 'integer'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
            [['kipato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vipato::className(), 'targetAttribute' => ['kipato_id' => 'id']],
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
            'kipato_id' => Yii::t('app', 'Kipato ID'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKipato()
    {
        return $this->hasOne(Vipato::className(), ['id' => 'kipato_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }
}
