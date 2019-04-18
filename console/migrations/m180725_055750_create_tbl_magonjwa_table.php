<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_magojwa`.
 */
class m180725_055750_create_tbl_magonjwa_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_magonjwa', [
            'id' => $this->primaryKey(),
            'ugonjwa' => $this->string(200)->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_magonjwa');
    }
}
