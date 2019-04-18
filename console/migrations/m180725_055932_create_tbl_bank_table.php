<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_bank`.
 */
class m180725_055932_create_tbl_bank_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_bank', [
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
        $this->dropTable('tbl_bank');
    }
}
