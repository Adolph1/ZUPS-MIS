<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_kituo_shehia".
 *
 * @property integer $id
 * @property integer $shehia_id
 * @property integer $kituo_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblVituo $kituo
 * @property TblShehia $shehia
 */
class KituoShehia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

 public static function tableName()
    {
        return 'tbl_kituo_shehia';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shehia_id', 'kituo_id'], 'integer'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
            [['kituo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vituo::className(), 'targetAttribute' => ['kituo_id' => 'id']],
            [['shehia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shehia::className(), 'targetAttribute' => ['shehia_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shehia_id' => Yii::t('app', 'Shehia'),
            'kituo_id' => Yii::t('app', 'Kituo'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShehia()
    {
        return $this->hasOne(Shehia::className(), ['id' => 'shehia_id']);
    }


    public static function getName($jina)
    {
        $shehia = KituoShehia::findOne(['shehia_id' => $jina]);
        if($shehia != null){
            return $shehia->kituo->kituo;
        }else{
            return null;
        }
    }

    public static function getKituoIdByShehiaId($shehia_id)
    {
        $shehia = KituoShehia::findOne(['shehia_id' => $shehia_id]);
        if($shehia != null){
            return $shehia->kituo->id;
        }else{
            return null;
        }
    }

    public static function getSheiaCount($id)
    {
        $shehias = KituoShehia::find()->where(['kituo_id' => $id])->count();
        if($shehias != null){
            return $shehias;
        }else{
            return 0;
        }
    }



}
