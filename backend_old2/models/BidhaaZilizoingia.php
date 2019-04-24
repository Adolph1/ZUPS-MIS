<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_bidhaa_zilizoingia".
 *
 * @property int $id
 * @property string $tarehe_ya_kuingia
 * @property int $bidhaa_id
 * @property string $jina_aliyeleta
 * @property string $idadi
 * @property string $jumla
 * @property string $aliyepokea
 * @property string $aliyeingiza
 * @property string $muda
 */
class BidhaaZilizoingia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_bidhaa_zilizoingia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarehe_ya_kuingia', 'bidhaa_id'], 'required'],
            [['tarehe_ya_kuingia', 'muda'], 'safe'],
            [['bidhaa_id'], 'integer'],
            [['idadi', 'jumla'], 'number'],
            [['jina_aliyeleta', 'aliyepokea', 'aliyeingiza'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarehe_ya_kuingia' => 'Tarehe Ya Kuingia',
            'bidhaa_id' => 'Bidhaa ID',
            'jina_aliyeleta' => 'Jina Aliyeleta',
            'idadi' => 'Idadi',
            'jumla' => 'Jumla',
            'aliyepokea' => 'Aliyepokea',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
        ];
    }

    public function getBidhaa()
    {
        return $this->hasOne(MatumiziMengine::className(), ['id' => 'bidhaa_id']);
    }
}
