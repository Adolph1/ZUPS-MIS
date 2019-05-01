<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_zone".
 *
 * @property integer $id
 * @property string $jina
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMkoa[] $tblMkoas
 */
class Zone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_zone';
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
    public function getTblMkoas()
    {
        return $this->hasMany(TblMkoa::className(), ['zone_id' => 'id']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(Zone::find()->all(),'id','jina');
    }
}
