<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_budget`.
 */
class m180704_073211_create_tbl_budget_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_budget', [
            'id' => $this->primaryKey(),
            'maelezo' => $this->string(200)->notNull(),
            'jumla_kiasi' => $this->decimal(10,2)->notNull(),
            'kumbukumbu_no' => $this->string(200)->notNull(),
            'kwa_mwezi' => $this->string(10),
            'kwa_mwaka' => $this->string(200),
            'status' => $this->integer(1),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
            'aliyethitisha' => $this->string(200),
            'muda_kuthibitisha' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_budget');
    }
}
