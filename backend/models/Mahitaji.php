<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_mahitaji".
 *
 * @property integer $id
 * @property string $hitaji
 * @property integer $aina_ya_hitaji
 * @property string $aliyeweka
 * @property string $muda
 */
class Mahitaji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $mahitaji_details;

    public static function tableName()
    {
        return 'tbl_mahitaji';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hitaji','aina_ya_hitaji'], 'required'],
            [['muda'], 'safe'],
            [['aina_ya_hitaji','category_id'], 'integer'],
            [['hitaji', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hitaji' => Yii::t('app', 'Hitaji'),
            'category_id' => Yii::t('app', 'Category'),
            'aina_ya_hitaji' => Yii::t('app', 'Aina ya uhitaji'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    public static function getAll()
    {
        return ArrayHelper::map(Mahitaji::find()->all(),'id','hitaji');
    }
    public static function getAllWithoutPosho()
    {
        return ArrayHelper::map(Mahitaji::find()->where(['<>','category_id',3])->all(),'id','hitaji');
    }

    public function getCategory()
    {
        return $this->hasOne(MahitajiCategory::className(), ['id' => 'category_id']);

    }

    public static function getMafuta()
    {
        return ArrayHelper::map(Mahitaji::find()->where(['category_id' => 1])->all(),'id','hitaji');
    }

}
