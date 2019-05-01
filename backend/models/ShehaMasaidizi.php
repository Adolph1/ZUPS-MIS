<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sheha_masaidizi".
 *
 * @property integer $id
 * @property integer $sheha_id
 * @property string $jina_kamili
 * @property string $tarehe_kuzaliwa
 * @property string $anuani_kamili
 * @property string $nambari_ya_simu
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblSheha $sheha
 */
class ShehaMasaidizi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sheha_masaidizi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sheha_id', 'jina_kamili'], 'required'],
            [['sheha_id'], 'integer'],
            [['tarehe_kuzaliwa', 'muda'], 'safe'],
            [['jina_kamili', 'anuani_kamili', 'nambari_ya_simu', 'aliyeweka'], 'string', 'max' => 200],
            [['sheha_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sheha::className(), 'targetAttribute' => ['sheha_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sheha_id' => Yii::t('app', 'Sheha ID'),
            'jina_kamili' => Yii::t('app', 'Jina Kamili'),
            'tarehe_kuzaliwa' => Yii::t('app', 'Tarehe Kuzaliwa'),
            'anuani_kamili' => Yii::t('app', 'Anuani Kamili'),
            'nambari_ya_simu' => Yii::t('app', 'Nambari Ya Simu'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSheha()
    {
        return $this->hasOne(Sheha::className(), ['id' => 'sheha_id']);
    }
}
