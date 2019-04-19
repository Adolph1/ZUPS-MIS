<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_ulemavu`.
 */
class m180725_055806_create_tbl_ulemavu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_ulemavu', [
            'id' => $this->primaryKey(),
            'jina' => $this->string()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_ulemavu');
    }
}
