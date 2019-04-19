<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_kituo_balance`.
 */
class m180906_200845_create_tbl_kituo_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_kituo_balance', [
            'id' => $this->primaryKey(),
            'kituo_id' => $this->integer(),
            'credit_turn_over' => $this->decimal(15,2),
            'debit_turn_over' => $this->decimal(15,2),
            'balance' => $this->decimal(15,0),
            'value_dt' => $this->date(),
            'updated_by' => $this->string(200),
            'updated_time' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_kituo_balance');
    }
}
