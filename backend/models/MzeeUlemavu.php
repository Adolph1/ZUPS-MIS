<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_mzee_ulemavu".
 *
 * @property integer $id
 * @property integer $mzee_id
 * @property integer $ulemavu_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMzee $mzee
 * @property TblUlemavu $ulemavu
 */
class MzeeUlemavu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mzee_ulemavu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['mzee_id', 'ulemavu_id'], 'required'],
            [['mzee_id', 'ulemavu_id'], 'integer'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
            [['ulemavu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ulemavu::className(), 'targetAttribute' => ['ulemavu_id' => 'id']],
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
            'ulemavu_id' => Yii::t('app', 'Ulemavu ID'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUlemavu()
    {
        return $this->hasOne(Ulemavu::className(), ['id' => 'ulemavu_id']);
    }

}
