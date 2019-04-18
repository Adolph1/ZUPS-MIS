<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_uhusiano`.
 */
class m180729_144646_create_tbl_uhusiano_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_uhusiano', [
            'id' => $this->primaryKey(),
            'jina' => $this->string()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_uhusiano');
    }
}
