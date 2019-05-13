<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_viambatanisho".
 *
 * @property integer $id
 * @property string $jina
 *
 * @property TblViambatanishoMzee[] $tblViambatanishoMzees
 */
class Viambatanisho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_viambatanisho';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['jina'], 'string', 'max' => 200],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblViambatanishoMzees()
    {
        return $this->hasMany(ViambatanishoMzee::className(), ['aina_id' => 'id']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(Viambatanisho::find()->all(),'id' ,'jina');
    }
}
