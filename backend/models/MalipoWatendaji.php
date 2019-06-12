<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_malipo_watendaji".
 *
 * @property integer $id
 * @property integer $muamala_id
 * @property string $tarehe_ya_kulipwa
 * @property string $kumbukumbu_no
 * @property string $product
 * @property string $jina_kamili
 * @property string $kiasi_alichopewa
 * @property string $kazi_yake
 * @property string $status
 *
 * @property TblMiamalaWatendaji $muamala
 */
class MalipoWatendaji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $date1;
    public $date2;

    public static function tableName()
    {
        return 'tbl_malipo_watendaji';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['muamala_id'], 'integer'],
            [['tarehe_ya_kulipwa'], 'safe'],
            [['jina_kamili'], 'required'],
            [['kiasi_alichopewa'], 'number'],
            [['status'], 'string', 'max' => 1],
            [['jina_kamili', 'kazi_yake','kumbukumbu_no','product'], 'string', 'max' => 200],
            [['muamala_id'], 'exist', 'skipOnError' => true, 'targetClass' => MiamalaWatendaji::className(), 'targetAttribute' => ['muamala_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'muamala_id' => 'Muamala ID',
            'tarehe_ya_kulipwa' => 'Tarehe Ya Kulipwa',
            'jina_kamili' => 'Jina Kamili',
            'kiasi_alichopewa' => 'Kiasi Alichopewa',
            'kazi_yake' => 'Kazi Yake',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMuamala()
    {
        return $this->hasOne(MiamalaWatendaji::className(), ['id' => 'muamala_id']);
    }

    public static function getPaidByTrnId($id)
    {
        $sum = MalipoWatendaji::find()->where(['muamala_id' => $id])->sum('kiasi_alichopewa');
        if($sum != null){
            return $sum;
        }else{
            return 0;
        }
    }
}
