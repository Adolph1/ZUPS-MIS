<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_aina_ya_kitambulisho`.
 */
class m180724_140029_create_tbl_aina_ya_kitambulisho_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_aina_ya_kitambulisho', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_aina_ya_kitambulisho');
    }
}
