<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_zone`.
 */
class m180725_060036_create_tbl_zone_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_zone', [
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
        $this->dropTable('tbl_zone');
    }
}
