<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_toa_mafuta".
 *
 * @property int $id
 * @property string $tarehe
 * @property int $wilaya_id
 * @property int $bidhaa_id
 * @property int $gari
 * @property string $kiasi
 * @property string $vocha
 * @property string $budget_qty
 * @property string $budget_id
 * @property string $bakaa
 * @property string $maker_id
 * @property string $maker_time
 */
class ToaMafuta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_toa_mafuta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarehe', 'maker_time'], 'safe'],
            [['wilaya_id', 'bidhaa_id', 'tarehe','gari', 'kiasi'], 'required'],
            [['wilaya_id', 'bidhaa_id', 'gari','budget_id'], 'integer'],
            [['kiasi','bakaa','budget_qty'], 'number'],
            [['vocha', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarehe' => 'Tarehe',
            'wilaya_id' => 'Wilaya',
            'bidhaa_id' => 'Matumizi',
            'gari' => 'Gari',
            'kiasi' => 'Idadi ya lita',
            'budget_qty' => 'Jumla katika bajeti',
            'vocha' => 'Vocha',
            'maker_id' => 'Maker ID',
            'maker_time' => 'Maker Time',
        ];
    }


    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_id']);
    }
    public function getBidhaa()
    {
        return $this->hasOne(Mahitaji::className(), ['id' => 'bidhaa_id']);
    }
    public function getVehicle()
    {
        return $this->hasOne(VehicleManagement::className(), ['id' => 'gari']);
    }
}
