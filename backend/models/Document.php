<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_document".
 *
 * @property integer $id
 * @property string $jina
 * @property integer $folder_id
 * @property string $uploaded_by
 * @property string $muda
 *
 * @property TblFolder $folder
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

    public static function tableName()
    {
        return 'tbl_document';
    }

    public static function getFilesCount($id)
    {
        $files = Document::findAll(['folder_id' => $id]);
        if($files != null){
            return count($files);
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
            [['folder_id'], 'integer'],
            [['muda'], 'safe'],
            [['jina', 'uploaded_by'], 'string', 'max' => 200],
            [['jina'], 'unique'],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['folder_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jina' => 'Jina',
            'folder_id' => 'Folder',
            'uploaded_by' => 'Uploaded By',
            'muda' => 'Muda',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'folder_id']);
    }
}
