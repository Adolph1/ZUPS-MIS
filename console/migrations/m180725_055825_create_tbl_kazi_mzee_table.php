<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_kazi_mzee`.
 */
class m180725_055825_create_tbl_kazi_mzee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_kazi_mzee', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_kazi_mzee');
    }
}
