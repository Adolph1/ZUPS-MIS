<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_vehicle_management".
 *
 * @property integer $id
 * @property string $tarehe_ya_kukodi
 * @property string $mmiliki_wa_gari
 * @property string $namba_ya_simu_mmiliki
 * @property string $aina_ya_gari
 * @property string $plate_number
 * @property string $jina_la_dereva
 * @property string $namba_ya_simu_dereva
 * @property integer $kituo_id
 * @property string $jumla_ya_fedha_mafuta
 * @property string $bei_ya_lita_moja
 * @property string $jumla_ya_lita
 * @property string $order_number
 * @property string $aliyeingiza
 * @property string $muda
 *
 * @property TblVituo $wilaya
 */
class VehicleManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_vehicle_management';
    }

    public static function getAll()
    {
        return ArrayHelper::map(VehicleManagement::find()->all(),'id',function ($model){
            return $model->aina_ya_gari . ' - ' .$model->plate_number;
        });
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarehe_ya_kukodi', 'mmiliki_wa_gari', 'namba_ya_simu_mmiliki', 'plate_number', 'jina_la_dereva', 'wilaya_id'], 'required'],
            [['tarehe_ya_kukodi', 'muda'], 'safe'],
            [['plate_number'], 'unique'],
            [['wilaya_id'], 'integer'],

            [['jumla_ya_fedha_mafuta', 'bei_ya_lita_moja', 'jumla_ya_lita'], 'number'],
            [['mmiliki_wa_gari', 'namba_ya_simu_mmiliki', 'aina_ya_gari', 'plate_number', 'jina_la_dereva', 'namba_ya_simu_dereva', 'order_number', 'aliyeingiza'], 'string', 'max' => 200],
            [['wilaya_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilaya::className(), 'targetAttribute' => ['wilaya_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarehe_ya_kukodi' => 'Tarehe Ya Kukodi',
            'mmiliki_wa_gari' => 'Mmiliki Wa Gari',
            'namba_ya_simu_mmiliki' => 'Namba Ya Simu Mmiliki',
            'aina_ya_gari' => 'Aina Ya Gari',
            'plate_number' => 'Plate Number',
            'jina_la_dereva' => 'Jina la Dereva',
            'namba_ya_simu_dereva' => 'Namba ya Dereva',
            'wilaya_id' => 'Wilaya',
            'jumla_ya_fedha_mafuta' => 'Jumla Ya Fedha Mafuta',
            'bei_ya_lita_moja' => 'Bei Ya Lita Moja',
            'jumla_ya_lita' => 'Jumla Ya Lita',
            'order_number' => 'Order Number',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_id']);
    }
}
