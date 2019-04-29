<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_bidhaa_zilizobaki".
 *
 * @property int $id
 * @property int $bidhaa_id
 * @property string $idadi
 * @property string $aliyeingiza
 * @property string $muda
 */
class BidhaaZilizobaki extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_bidhaa_zilizobaki';
    }

    public static function addStoke($id, $idadi)
    {
        $store = BidhaaZilizobaki::findOne(['bidhaa_id' => $id]);
        if($store != null){
            $store->idadi = $store->idadi + $idadi;
            BidhaaZilizobaki::updateAll(['idadi' => $store->idadi],['bidhaa_id' => $id,'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);

        }else{
            $store = new BidhaaZilizobaki();
            $store->bidhaa_id = $id;
            $store->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
            $store->idadi = $idadi;
            $store->aliyeingiza = Yii::$app->user->identity->username;
            $store->muda = date('Y-m-d H:i:s');
            $store->save();
        }
    }

    public static function lessStoke($id, $idadi)
    {
        $store = BidhaaZilizobaki::findOne(['bidhaa_id' => $id]);
        if($store != null){
            $store->idadi = $store->idadi - $idadi;
            BidhaaZilizobaki::updateAll(['idadi' => $store->idadi],['bidhaa_id' => $id]);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['bidhaa_id'], 'required'],
            [['bidhaa_id'], 'integer'],
            [['idadi'], 'number'],
            [['muda'], 'safe'],
            [['aliyeingiza'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bidhaa_id' => 'Bidhaa ID',
            'idadi' => 'Idadi',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
        ];
    }
    public function getBidhaa()
    {
        return $this->hasOne(MatumiziMengine::className(), ['id' => 'bidhaa_id']);
    }
}
