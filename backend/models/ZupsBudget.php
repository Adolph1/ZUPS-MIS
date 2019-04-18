<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_zups_budget".
 *
 * @property int $id
 * @property string $mwezi
 * @property string $mwaka
 * @property string $jumla_iliyoombwa
 * @property string $jumla_iliyotolewa
 * @property string $bakaa
 * @property int $status
 * @property string $aliyeingiza
 * @property string $muda
 */
class ZupsBudget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const OPEN = 0;
    const REVIEWED = 1;
    const APPROVED = 2;
    const SECONDAPPROVAL = 3;
    const REJECTED = 4;
    const FUNDED = 5;
    private $_statusLabel;

    public static function tableName()
    {
        return 'tbl_zups_budget';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jumla_iliyoombwa', 'jumla_iliyotolewa', 'bakaa'], 'number'],
            [['status'], 'integer'],
            [['muda'], 'safe'],
            [['mwezi'], 'string', 'max' => 2],
            [['mwaka'], 'string', 'max' => 4],
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
            'mwezi' => 'Mwezi',
            'mwaka' => 'Mwaka',
            'jumla_iliyoombwa' => 'Jumla Iliyoombwa',
            'jumla_iliyotolewa' => 'Jumla Iliyotolewa',
            'bakaa' => 'Bakaa',
            'status' => 'Status',
            'aliyeingiza' => 'Aliyeingiza',
            'muda' => 'Muda',
        ];
    }

    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getStatuses();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }


    public static function getStatuses()
    {
        return [

            self::OPEN => Yii::t('app', 'Inasubiri Kupitiwa'),
            self::REVIEWED => Yii::t('app', 'Imeshapitiwa'),
            self::APPROVED => Yii::t('app', 'Imepitishwa mara ya kwanza'),
            self::SECONDAPPROVAL => Yii::t('app', 'Imepitishwa mara ya pili'),
            self::REJECTED => Yii::t('app', 'Imekataliwa'),
            self::FUNDED => Yii::t('app', 'Pesa zimepokezwa'),

        ];
    }
}
