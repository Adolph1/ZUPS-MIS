<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_cashier_account`.
 */
class m180816_095437_create_tbl_cashier_account_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_cashier_account', [
            'id' => $this->primaryKey(),
            'cashier_id' => $this->integer()->notNull(),
            'account' => $this->string(20)->notNull(),
            'opening_balance' => $this->decimal(10,2),
            'current_balance' => $this->decimal(10,2),
            'maker_id' => $this->string(200),
            'maker_time' => $this->dateTime()
        ]);


        // creates index for column `cashier_id`
        $this->createIndex(
            'idx-tbl_cashier_account-cashier_id',
            'tbl_cashier_account',
            'cashier_id'
        );


        $this->addForeignKey(
            'fk-tbl_cashier_account-cashier_id',
            'tbl_cashier_account',
            'cashier_id',
            'tbl_wafanyakazi',
            'id',
            'RESTRICT'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_cashier_account');
    }
}
