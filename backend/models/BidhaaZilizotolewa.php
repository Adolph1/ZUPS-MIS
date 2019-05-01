<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_bidhaa_zilizotolewa".
 *
 * @property int $id
 * @property string $tarehe_ya_kutoka
 * @property int $bidhaa_id
 * @property string $jina_aliyetoa
 * @property string $idadi
 * @property string $jumla
 * @property string $aliyepokea
 * @property string $aliyeingiza
 * @property string $muda
 */
class BidhaaZilizotolewa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_bidhaa_zilizotolewa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarehe_ya_kutoka', 'bidhaa_id'], 'required'],
            [['tarehe_ya_kutoka', 'muda'], 'safe'],
            [['bidhaa_id'], 'integer'],
            [['idadi', 'jumla'], 'number'],
            [['jina_aliyetoa', 'aliyepokea', 'aliyeingiza','maelezo_zaidi'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarehe_ya_kutoka' => 'Tarehe Ya Kutoka',
            'maelezo_zaidi' => 'Maelezo Zaidi',
            'bidhaa_id' => 'Maelezo ya bidhaa',
            'jina_aliyetoa' => 'Jina Aliyetoa',
            'idadi' => 'Idadi',
            'jumla' => 'Jumla',
            'aliyepokea' => 'Aliyepokea',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
        ];
    }
}
