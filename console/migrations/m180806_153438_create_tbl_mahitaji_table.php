<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_mahitaji`.
 */
class m180806_153438_create_tbl_mahitaji_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_mahitaji', [
            'id' => $this->primaryKey(),
            'hitaji' => $this->string(200)->notNull(),
            'aina_ya_hitaji' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_mahitaji');
    }
}
