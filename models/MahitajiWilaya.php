<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_mahitaji_wilaya".
 *
 * @property integer $id
 * @property integer $wilaya_id
 * @property integer $hitaji_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMahitaji $hitaji
 * @property TblWilaya $wilaya
 */
class MahitajiWilaya extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $mahitaji;

    public static function tableName()
    {
        return 'tbl_mahitaji_wilaya';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wilaya_id',], 'required'],
            [['wilaya_id',], 'integer'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
            [['hitaji_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mahitaji::className(), 'targetAttribute' => ['hitaji_id' => 'id']],
            [['wilaya_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilaya::className(), 'targetAttribute' => ['wilaya_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'wilaya_id' => Yii::t('app', 'Wilaya'),
            'hitaji_id' => Yii::t('app', 'Hitaji'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHitaji()
    {
        return $this->hasOne(Mahitaji::className(), ['id' => 'hitaji_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_id']);
    }
}
