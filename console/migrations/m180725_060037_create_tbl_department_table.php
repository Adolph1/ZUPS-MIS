<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_department`.
 */
class m180725_060037_create_tbl_department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_department', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_department');
    }
}
