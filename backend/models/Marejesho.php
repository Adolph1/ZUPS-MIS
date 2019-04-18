<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_marejesho".
 *
 * @property int $id
 * @property string $tarehe
 * @property int $mahesabu_id
 * @property string $kiasi
 * @property string $kilichobaki
 * @property string $aliyepokea
 * @property string $muda_alioingiza
 */
class Marejesho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_marejesho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kiasi'], 'required'],
            [['tarehe', 'muda_alioingiza'], 'safe'],
            [['mahesabu_id'], 'integer'],
            [['kiasi', 'kilichobaki'], 'number'],
            [['aliyepokea'], 'string', 'max' => 200],
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
            'mahesabu_id' => 'Mahesabu ID',
            'kiasi' => 'Kiasi',
            'kilichobaki' => 'Kilichobaki',
            'aliyepokea' => 'Aliyepokea',
            'muda_alioingiza' => 'Muda Alioingiza',
        ];
    }
}
