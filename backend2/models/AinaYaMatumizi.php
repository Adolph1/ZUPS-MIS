<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_aina_ya_matumizi".
 *
 * @property integer $id
 * @property string $matumizi
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblOfficeSupervisor[] $tblOfficeSupervisors
 */
class AinaYaMatumizi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_aina_ya_matumizi';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matumizi'], 'required'],
            [['muda'], 'safe'],
            [['matumizi', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'matumizi' => Yii::t('app', 'Matumizi'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblOfficeSupervisors()
    {
        return $this->hasMany(TblOfficeSupervisor::className(), ['aina_id' => 'id']);
    }


    public static function getAll()
    {
       return ArrayHelper::map(AinaYaMatumizi::find()->all(),'id','matumizi');
    }
}
