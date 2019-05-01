<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_supplier".
 *
 * @property int $id
 * @property string $jina
 * @property string $namba_ya_simu
 * @property string $mtaa
 * @property string $aina_ya_biashara
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_supplier';
    }

    public static function getAll()
    {
        return ArrayHelper::map(Supplier::find()->all(),'id','jina');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jina'], 'required'],
            [['jina', 'namba_ya_simu', 'mtaa', 'aina_ya_biashara'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jina' => 'Jina',
            'namba_ya_simu' => 'Namba Ya Simu',
            'mtaa' => 'Mtaa',
            'aina_ya_biashara' => 'Aina Ya Biashara',
        ];
    }
}
