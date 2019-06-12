<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_sheha".
 *
 * @property integer $id
 * @property string $jina_kamili
 * @property string $mtaa
 * @property string $nyumba_namba
 * @property string $jinsia
 * @property string $simu
 * @property integer $wilaya_id
 * @property string $tarehe_kuzaliwa
 * @property integer $shehia_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblWilaya $wilaya
 * @property TblShehia[] $tblShehias
 */
class Sheha extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const ACTIVE = 0;
    const DISABLED = 1;
    public static function tableName()
    {
        return 'tbl_sheha';
    }





    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina_kamili','aina','jinsia', 'simu', 'wilaya_id'], 'required'],
            [['wilaya_id', 'shehia_id','aina','status'], 'integer'],
            [['tarehe_kuzaliwa', 'muda'], 'safe'],
            [['jina_kamili', 'mtaa', 'nyumba_namba', 'simu', 'aliyeweka'], 'string', 'max' => 200],
            [['jinsia'], 'string', 'max' => 1],
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
            'jina_kamili' => Yii::t('app', 'Jina Kamili'),
            'mtaa' => Yii::t('app', 'Mtaa'),
            'nyumba_namba' => Yii::t('app', 'Namba ya Nyumba'),
            'jinsia' => Yii::t('app', 'Jinsia'),
            'simu' => Yii::t('app', 'Simu'),
            'wilaya_id' => Yii::t('app', 'Wilaya'),
            'tarehe_kuzaliwa' => Yii::t('app', 'Tarehe ya Kuzaliwa'),
            'shehia_id' => Yii::t('app', 'Shehia'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShehia()
    {
        return $this->hasOne(Shehia::className(), ['id' => 'shehia_id']);
    }

    public static function getAll($id)
    {
        return ArrayHelper::map(Sheha::find()->where(['shehia_id' => $id,'status' => Sheha::ACTIVE])->all(),'id','jina_kamili');
    }
}
