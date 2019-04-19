<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_cash_book`.
 */
class m180816_194355_create_tbl_cash_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_cash_book', [
            'id' => $this->primaryKey(),
            'trn_dt' => $this->date()->notNull(),
            'amount' => $this->decimal(10,2)->notNull(),
            'gl_account' => $this->string(200)->notNull(),
            'dr_cr' => $this->char(1)->notNull(),
            'description' => $this->string(200),
            'auth_stat' => $this->char(1),
            'delete_stat' => $this->char(1),
            'maker_id' => $this->string(200),
            'maker_time' => $this->dateTime(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_cash_book');
    }
}
