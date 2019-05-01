<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_viambatanisho_mzee`.
 */
class m180731_060829_create_tbl_viambatanisho_mzee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_viambatanisho_mzee', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_viambatanisho_mzee');
    }
}
