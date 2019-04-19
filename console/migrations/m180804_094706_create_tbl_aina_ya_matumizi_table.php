<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_aina_ya_matumizi`.
 */
class m180804_094706_create_tbl_aina_ya_matumizi_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_aina_ya_matumizi', [
            'id' => $this->primaryKey(),
            'matumizi' => $this->string(200)->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_aina_ya_matumizi');
    }
}
