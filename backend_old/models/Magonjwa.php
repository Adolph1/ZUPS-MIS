<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_magonjwa".
 *
 * @property integer $id
 * @property string $ugonjwa
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMzeeMagonjwa[] $tblMzeeMagonjwas
 */
class Magonjwa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_magonjwa';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ugonjwa'], 'required'],
            [['muda'], 'safe'],
            [['ugonjwa', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ugonjwa' => Yii::t('app', 'Ugonjwa'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMzeeMagonjwas()
    {
        return $this->hasMany(TblMzeeMagonjwa::className(), ['ugonjwa_id' => 'id']);
    }
    public static function getAll()
    {
        return ArrayHelper::map(Magonjwa::find()->all(),'id','ugonjwa');
    }
}
