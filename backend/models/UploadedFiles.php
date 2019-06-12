<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_uploaded_files".
 *
 * @property int $id
 * @property string $name
 * @property string $uploaded_by
 * @property string $uploaded_date
 * @property string $time_uploaded
 * @property string $status
 */
class UploadedFiles extends \yii\db\ActiveRecord
{
    const UPLOADED = 0;
    const PROCESSED = 1;
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_uploaded_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uploaded_date', 'time_uploaded'], 'safe'],
            [['name', 'uploaded_by','file'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'uploaded_by' => 'Imepakiwa Na:',
            'uploaded_date' => 'Muda wa malipo',
            'time_uploaded' => 'Tarehe|Muda',
            'status' => 'Status',
        ];
    }
}
