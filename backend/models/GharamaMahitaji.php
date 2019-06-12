<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_gharama_mahitaji".
 *
 * @property integer $id
 * @property integer $budget_id
 * @property integer $hitaji_id
 * @property integer $wilaya_id
 * @property integer $idadi_ya_siku
 * @property integer $idadi_ya_vitu
 * @property string $gharama
 * @property string $total
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblBudget $budget
 * @property TblMahitaji $hitaji
 * @property TblWilaya $wilaya
 */
class GharamaMahitaji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const PAID = 1;
    const PENDING = 0;

    public static function tableName()
    {
        return 'tbl_gharama_mahitaji';
    }

    public static function getCurrentSum()
    {
        $budget = Budget::findOne(['kwa_mwezi' => date('m'),'kwa_mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        if($budget != null) {

            return GharamaMahitaji::find()->where(['budget_id' => $budget->id])->sum('total');
        }
    }

    public static function getIdadiById($id)
    {
        $mahitaji = GharamaMahitaji::find()->where(['budget_id' => Budget::getCurrent(),'hitaji_id' => $id,'status' => GharamaMahitaji::PENDING])->all();
        if($mahitaji != null){
            $sum = 0.00;
            foreach ($mahitaji as $hitaji){
                $sum = $sum + ($hitaji->idadi_ya_vitu *$hitaji->idadi_ya_siku);
            }
            return $sum;
        }else{
            return 0.00;
        }
    }

    public static function getJumlaById($id)
    {
        $mahitaji = GharamaMahitaji::find()->where(['budget_id' => Budget::getCurrent(),'hitaji_id' => $id,'status' => GharamaMahitaji::PENDING])->all();
        if($mahitaji != null){
            $sum = 0.00;
            foreach ($mahitaji as $hitaji){
                $sum = $sum + ($hitaji->idadi_ya_vitu *$hitaji->idadi_ya_siku*$hitaji->gharama);
            }
            return $sum;
        }else{
            return 0.00;
        }
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['budget_id', 'hitaji_id', 'idadi_ya_siku', 'idadi_ya_vitu','gharama'], 'required'],
            [['budget_id', 'hitaji_id', 'wilaya_id', 'idadi_ya_siku', 'idadi_ya_vitu'], 'integer'],
            [['gharama', 'total'], 'number'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['hitaji_id'], 'exist', 'skipOnError' => false, 'targetClass' => Mahitaji::className(), 'targetAttribute' => ['hitaji_id' => 'id']],
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
            'budget_id' => Yii::t('app', 'Budget'),
            'hitaji_id' => Yii::t('app', 'Hitaji'),
            'wilaya_id' => Yii::t('app', 'Wilaya'),
            'idadi_ya_siku' => Yii::t('app', 'Siku'),
            'idadi_ya_vitu' => Yii::t('app', 'Idadi'),
            'gharama' => Yii::t('app', 'Gharama'),
            'total' => Yii::t('app', 'Jumla'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
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

    public static function getSum($id)
    {
        return GharamaMahitaji::find()->where(['budget_id' => $id])->sum('total');
    }
}
