<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_vipato`.
 */
class m180725_055914_create_tbl_vipato_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_vipato', [
            'id' => $this->primaryKey(),
            'kipato' => $this->string(200)->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_vipato');
    }
}
