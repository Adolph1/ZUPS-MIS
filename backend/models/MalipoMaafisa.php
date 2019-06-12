<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_malipo_maafisa".
 *
 * @property integer $id
 * @property integer $budget_id
 * @property integer $zone_id
 * @property string $jina_kamili
 * @property string $kazi
 * @property string $namba_ya_simu
 * @property double $kiasi
 * @property string $tarehe_ya_malipo
 * @property string $kumbukumbu_no
 * @property string $aliyeingiza
 * @property string $muda
 * @property string $ofisi_aliyotoka
 * @property string $status
 * @property string $kazi_anayoenda_kufanya
 * @property string $product
 * @property integer $kituo_id
 * @property integer $wilaya_id
 *
 * @property TblBudget $budget
 * @property TblZone $zone
 * @property TblVituo $kituo
 */
class MalipoMaafisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $date1;
    public $date2;




    public static function tableName()
    {
        return 'tbl_malipo_maafisa';
    }

    public static function getTotalPaid($budgetId)
    {
        $sum = MalipoMaafisa::find()->where(['budget_id' => $budgetId])->sum('kiasi');
        if($sum != null){
            return $sum;
        }else{
            return 0;
        }
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jina_kamili', 'kazi', 'kiasi', 'tarehe_ya_malipo', 'kumbukumbu_no', 'ofisi_aliyotoka', 'kazi_anayoenda_kufanya', 'kituo_id'], 'required'],
            [['budget_id', 'zone_id', 'kituo_id'], 'integer'],
            [['kiasi'], 'number','numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['tarehe_ya_malipo', 'muda'], 'safe'],
            [['jina_kamili', 'kazi', 'kumbukumbu_no', 'aliyeingiza', 'ofisi_aliyotoka', 'kazi_anayoenda_kufanya','product'], 'string', 'max' => 200],
            [['namba_ya_simu'], 'string', 'max' => 13],
            [['status'], 'string', 'max' => 1],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' =>Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['zone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zone::className(), 'targetAttribute' => ['zone_id' => 'id']],
            [['kituo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vituo::className(), 'targetAttribute' => ['kituo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'budget_id' => 'Budget',
            'zone_id' => 'Zone',
            'jina_kamili' => 'Jina Kamili',
            'kazi' => 'Kazi',
            'namba_ya_simu' => 'Namba Ya Simu',
            'kiasi' => 'Kiasi',
            'tarehe_ya_malipo' => 'Tarehe Ya Malipo',
            'kumbukumbu_no' => 'Kumbukumbu No',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
            'ofisi_aliyotoka' => 'Ofisi Aliyotoka',
            'kazi_anayoenda_kufanya' => 'Kazi Anayoenda Kufanya',
            'kituo_id' => 'Kituo ',
            'wilaya_id' => 'Wilaya ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZone()
    {
        return $this->hasOne(Zone::className(), ['id' => 'zone_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }

    public function beforeSave($insert) {

        if (parent::beforeSave($insert)) {

            $this->kiasi = str_replace(",", "", $this->kiasi);

            return true;

        } else {

            return false;

        }

    }
}
