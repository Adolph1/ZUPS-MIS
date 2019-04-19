<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_vituo".
 *
 * @property integer $id
 * @property string $kituo
 * @property integer $wilaya_id
 *
 * @property TblKituoShehia[] $tblKituoShehias
 */
class Vituo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $shehias;
    public $cashiers;

    public static function tableName()
    {
        return 'tbl_vituo';
    }

    public static function getWilayaIDByKituoID($kituo_id)
    {
        $kituo = Vituo::findOne($kituo_id);
        if($kituo != null){
            return $kituo->wilaya_id;
        }else{
            return null;
        }
    }

    public static function getNameByID($pay_point_id)
    {
        $kituo = Vituo::findOne($pay_point_id);
        if($kituo != null){
            return $kituo->kituo;
        }else{
            return null;
        }
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kituo','wilaya_id'], 'required'],
            [['wilaya_id'], 'integer'],
            [['shehias','cashiers'], 'safe'],
            [['kituo'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kituo' => Yii::t('app', 'Kituo'),
            'wilaya_id' => Yii::t('app', 'Wilaya'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituoShehias()
    {
        return $this->hasMany(KituoShehia::className(), ['kituo_id' => 'id']);
    }

    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_id']);

    }

    public static function getAll()
    {
        $mkoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mkoa]);
        return ArrayHelper::map(Vituo::find()->where(['in','wilaya_id',$wilaya])->all(),'id','kituo');
    }

    public static function getNotTaken()
    {
        $mkoa = Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mkoa]);
        $vituoPending = MahesabuYaliofungwa::find()->select('kituo_id')->where(['status' => null]);
        return ArrayHelper::map(Vituo::find()->where(['not in','id',$vituoPending])->andWhere(['in','wilaya_id',$wilaya])->all(),'id','kituo');
    }

}
