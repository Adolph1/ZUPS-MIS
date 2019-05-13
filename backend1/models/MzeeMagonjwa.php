<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_mzee_magonjwa".
 *
 * @property integer $id
 * @property integer $mzee_id
 * @property integer $ugonjwa_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMzee $mzee
 * @property TblMagonjwa $ugonjwa
 */
class MzeeMagonjwa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mzee_magonjwa';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['mzee_id', 'ugonjwa_id'], 'required'],
            [['mzee_id', 'ugonjwa_id'], 'integer'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
            [['ugonjwa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Magonjwa::className(), 'targetAttribute' => ['ugonjwa_id' => 'id']],
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
            'ugonjwa_id' => Yii::t('app', 'Ugonjwa ID'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzee()
    {
        return $this->hasOne(TblMzee::className(), ['id' => 'mzee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUgonjwa1()
    {
        return $this->hasOne(Magonjwa::className(), ['id' => 'ugonjwa_id']);
    }


}
