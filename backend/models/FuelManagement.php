<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_fuel_management".
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string $kiasi_cha_mafuta
 * @property string $tarehe
 * @property string $dereva
 * @property string $aliyeingiza
 * @property string $muda
 */
class FuelManagement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_fuel_management';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'kiasi_cha_mafuta','order_number', 'tarehe', 'dereva'], 'required'],
            [['vehicle_id'], 'integer'],
            [['kiasi_cha_mafuta'], 'number'],
            [['tarehe', 'muda'], 'safe'],
            [['dereva', 'aliyeingiza','order_number'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vehicle_id' => 'Taarifa za gari',
            'kiasi_cha_mafuta' => 'Kiasi Cha Mafuta',
            'tarehe' => 'Tarehe',
            'dereva' => 'Dereva',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
        ];
    }
}
