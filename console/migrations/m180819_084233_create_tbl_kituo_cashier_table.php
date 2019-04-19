<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_kituo_cashier`.
 */
class m180819_084233_create_tbl_kituo_cashier_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_kituo_cashier', [
            'id' => $this->primaryKey(),
            'cashier_id' => $this->integer(),
            'kituo_id' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
        // creates index for column `cashier_id`
        $this->createIndex(
            'idx-tbl_kituo_cashier-cashier_id',
            'tbl_kituo_cashier',
            'cashier_id'
        );


        $this->addForeignKey(
            'fk-tbl_kituo_cashier-cashier_id',
            'tbl_kituo_cashier',
            'cashier_id',
            'tbl_wafanyakazi',
            'id',
            'RESTRICT'
        );

        // creates index for column `kituo_id`
        $this->createIndex(
            'idx-tbl_kituo_cashier-kituo_id',
            'tbl_kituo_cashier',
            'kituo_id'
        );


        $this->addForeignKey(
            'fk-tbl_kituo_cashier-kituo_id',
            'tbl_kituo_cashier',
            'kituo_id',
            'tbl_vituo',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_kituo_cashier');
    }
}
