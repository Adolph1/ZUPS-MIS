<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_hamisha_mzee".
 *
 * @property int $id
 * @property int $mzee_id
 * @property int $mkoa_anaokwenda
 * @property int $wilaya_anayokwenda
 * @property int $shehia_anayokwenda
 * @property string $sababu
 * @property int $mkoa_aliotoka
 * @property int $wilaya_aliyotoka
 * @property int $shehia_aliyotoka
 * @property string $tarehe
 * @property string $aliyeingiza
 * @property string $muda
 * @property integer $status
 */
class HamishaMzee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_hamisha_mzee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mzee_id', 'mkoa_anaokwenda', 'wilaya_anayokwenda', 'shehia_anayokwenda', 'sababu', 'tarehe'], 'required'],
            [['mzee_id', 'mkoa_anaokwenda', 'wilaya_anayokwenda', 'shehia_anayokwenda', 'mkoa_aliotoka', 'wilaya_aliyotoka', 'shehia_aliyotoka','status'], 'integer'],
            [['tarehe', 'muda'], 'safe'],
            [['sababu', 'aliyeingiza'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mzee_id' => 'Mzee ID',
            'mkoa_anaokwenda' => 'Mkoa Anaokwenda',
            'wilaya_anayokwenda' => 'Wilaya Anayokwenda',
            'shehia_anayokwenda' => 'Shehia Anayokwenda',
            'sababu' => 'Sababu',
            'mkoa_aliotoka' => 'Mkoa Aliotoka',
            'wilaya_aliyotoka' => 'Wilaya Aliyotoka',
            'shehia_aliyotoka' => 'Shehia Aliyotoka',
            'tarehe' => 'Tarehe',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShehia()
    {
        return $this->hasOne(Shehia::className(), ['id' => 'shehia_anayokwenda']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_anayokwenda']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkoa()
    {
        return $this->hasOne(Mkoa::className(), ['id' => 'mkoa_anaokwenda']);
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromShehia()
    {
        return $this->hasOne(Shehia::className(), ['id' => 'shehia_aliyotoka']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_aliyotoka']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromMkoa()
    {
        return $this->hasOne(Mkoa::className(), ['id' => 'mkoa_aliotoka']);
    }

    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }
}
