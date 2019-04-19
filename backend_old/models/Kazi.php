<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_kazi".
 *
 * @property integer $id
 * @property string $jina
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblWafanyakazi[] $tblWafanyakazis
 */
class Kazi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kazi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['muda'], 'safe'],
            [['jina', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jina' => Yii::t('app', 'Jina'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblWafanyakazis()
    {
        return $this->hasMany(Wafanyakazi::className(), ['kazi_id' => 'id']);
    }


    public static function getAll()
    {
        return ArrayHelper::map(Kazi::find()->all(),'id','jina');
    }

}
