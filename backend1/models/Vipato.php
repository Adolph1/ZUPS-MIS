<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_vipato".
 *
 * @property integer $id
 * @property string $kipato
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMzeeVipato[] $tblMzeeVipatos
 */
class Vipato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_vipato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kipato'], 'required'],
            [['muda'], 'safe'],
            [['kipato', 'aliyeweka'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kipato' => Yii::t('app', 'Kipato'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMzeeVipatos()
    {
        return $this->hasMany(TblMzeeVipato::className(), ['kipato_id' => 'id']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(Vipato::find()->all(),'id','kipato');
    }
}
