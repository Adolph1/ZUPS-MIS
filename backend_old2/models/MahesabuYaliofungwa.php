<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_mahesabu_yaliofungwa".
 *
 * @property integer $id
 * @property string $tarehe_ya_kupewa
 * @property integer $cashier_id
 * @property integer $kituo_id
 * @property integer $trn_id
 * @property string $kiasi_alichopewa
 * @property string $kiasi_kilichotumika
 * @property string $kiasi_alichorudisha
 * @property string $kiasi_kilichobaki
 * @property string $tarehe_ya_kufunga
 * @property string $maelezo_zaid
 * @property string $status
 * @property string $aliyepokea
 * @property string $muda
 *
 * @property TblWafanyakazi $cashier
 * @property TblVituo $kituo
 */
class MahesabuYaliofungwa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $jina_la_karani;
    public $jina_la_kituo;
    const CLOSED = 'C';
    const PENDING = 'P';

    public static function tableName()
    {
        return 'tbl_mahesabu_yaliofungwa';
    }

    public static function getCashiers()
    {
        $cashiers = MahesabuYaliofungwa::find()->select('cashier_id')->where(['status' => 'C',]);
        return ArrayHelper::map(Wafanyakazi::find()->where(['in','id',$cashiers])->all(),'id','jina_kamili');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarehe_ya_kupewa', 'tarehe_ya_kufunga', 'muda'], 'safe'],
            [['cashier_id', 'kituo_id','trn_id'], 'integer'],
            [['kiasi_alichopewa', 'kiasi_kilichotumika', 'kiasi_alichorudisha', 'kiasi_kilichobaki'], 'number'],
            [['maelezo_zaid', 'aliyepokea'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['cashier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wafanyakazi::className(), 'targetAttribute' => ['cashier_id' => 'id']],
            [['kituo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vituo::className(), 'targetAttribute' => ['kituo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tarehe_ya_kupewa' => Yii::t('app', 'Tarehe Ya Kupewa'),
            'cashier_id' => Yii::t('app', 'Cashier '),
            'kituo_id' => Yii::t('app', 'Kituo '),
            'kiasi_alichopewa' => Yii::t('app', 'Kiasi Alichopewa'),
            'kiasi_kilichotumika' => Yii::t('app', 'Kiasi Kilichotumika'),
            'kiasi_alichorudisha' => Yii::t('app', 'Kiasi Alichorudisha'),
            'kiasi_kilichobaki' => Yii::t('app', 'Kiasi Kilichobaki'),
            'tarehe_ya_kufunga' => Yii::t('app', 'Tarehe Ya Kufunga'),
            'maelezo_zaid' => Yii::t('app', 'Maelezo Zaid'),
            'status' => Yii::t('app', 'Status'),
            'aliyepokea' => Yii::t('app', 'Aliyepokea'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashier()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'cashier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }
}
