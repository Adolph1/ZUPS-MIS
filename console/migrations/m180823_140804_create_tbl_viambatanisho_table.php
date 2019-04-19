<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_viambatanisho`.
 */
class m180823_140804_create_tbl_viambatanisho_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_viambatanisho', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_viambatanisho');
    }
}
