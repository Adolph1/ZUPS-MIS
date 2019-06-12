<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_uhakiki_form".
 *
 * @property integer $id
 * @property string $tarehe_ya_uhakiki
 * @property string $aliyemhakiki
 * @property integer $mzee_id
 * @property string $maoni_ya_uhakiki
 *
 * @property TblMzee $mzee
 */
class UhakikiForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_uhakiki_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarehe_ya_uhakiki'], 'safe'],
            [['mzee_id'], 'integer'],
            [['maoni_ya_uhakiki'], 'string'],
            [['aliyemhakiki'], 'string', 'max' => 200],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarehe_ya_uhakiki' => 'Tarehe Ya Uhakiki',
            'aliyemhakiki' => 'Aliyemhakiki',
            'mzee_id' => 'Mzee ID',
            'maoni_ya_uhakiki' => 'Maoni Ya Uhakiki',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }
}
