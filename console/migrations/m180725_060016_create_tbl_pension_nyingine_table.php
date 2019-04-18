<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_pension_nyingine`.
 */
class m180725_060016_create_tbl_pension_nyingine_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_pension_nyingine', [
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
        $this->dropTable('tbl_pension_nyingine');
    }
}
