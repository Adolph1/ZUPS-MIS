<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_ulemavu".
 *
 * @property integer $id
 * @property string $jina
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMzeeUlemavu[] $tblMzeeUlemavus
 */
class Ulemavu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ulemavu';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['muda'], 'safe'],
            [['jina'], 'string', 'max' => 255],
            [['aliyeweka'], 'string', 'max' => 200],
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
    public function getTblMzeeUlemavus()
    {
        return $this->hasMany(TblMzeeUlemavu::className(), ['ulemavu_id' => 'id']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(Ulemavu::find()->all(),'id','jina');
    }
}
