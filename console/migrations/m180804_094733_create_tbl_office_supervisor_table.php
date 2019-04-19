<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_office_supervisor`.
 */
class m180804_094733_create_tbl_office_supervisor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_office_supervisor', [
            'id' => $this->primaryKey(),
            'aina_id' => $this->integer()->notNull(),
            'kiasi' => $this->decimal(10,2)->notNull(),
            'maelezo' => $this->string(200)->notNull(),
            'budget_id' => $this->integer()->notNull(),
            'kiambatanisho' => $this->string(200),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `budget_id`
        $this->createIndex(
            'idx-tbl_office_supervisor-budget_id',
            'tbl_office_supervisor',
            'budget_id'
        );


        $this->addForeignKey(
            'fk-tbl_office_supervisor-budget_id',
            'tbl_office_supervisor',
            'budget_id',
            'tbl_budget',
            'id',
            'CASCADE'
        );

        // creates index for column `aina_id`
        $this->createIndex(
            'idx-tbl_office_supervisor-aina_id',
            'tbl_office_supervisor',
            'aina_id'
        );


        $this->addForeignKey(
            'fk-tbl_office_supervisor-aina_id',
            'tbl_office_supervisor',
            'aina_id',
            'tbl_aina_ya_matumizi',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_office_supervisor');
    }
}
