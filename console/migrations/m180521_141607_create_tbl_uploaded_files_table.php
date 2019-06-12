<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_uploaded_files`.
 */
class m180521_141607_create_tbl_uploaded_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_uploaded_files', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200),
            'uploaded_by' => $this->string(200),
            'uploaded_date' => $this->date(),
            'time_uploaded' => $this->dateTime(),
            'status' => $this->char(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_uploaded_files');
    }
}
