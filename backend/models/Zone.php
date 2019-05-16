<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_zone".
 *
 * @property integer $id
 * @property string $jina
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblMkoa[] $tblMkoas
 */
class Zone extends \yii\db\ActiveRecord
{
    const PEMBA = 2;
    const UNGUJA = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_zone';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['muda'], 'safe'],
            [['jina', 'aliyeweka'], 'string', 'max' => 200],
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
    public function getMikoa()
    {
        return $this->hasMany(Mkoa::className(), ['zone_id' => 'id']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(Zone::find()->all(),'id','jina');
    }

    public static function getZoneNameByuserId($user_id)
    {
        $mfanyakazi = Wafanyakazi::findOne($user_id);
        if($mfanyakazi != null){
            $zone = Zone::findOne($mfanyakazi->zone_id);
            if($zone != null) {
                return $zone->jina;
            }else{
                return ' ';
            }
        }else{
            return '';
        }
    }


}
