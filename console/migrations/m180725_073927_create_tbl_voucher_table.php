<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_voucher`.
 */
class m180725_073927_create_tbl_voucher_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_voucher', [
            'id' => $this->primaryKey(),
            'tarehe_kuandaliwa' => $this->date()->notNull(),
            'kumbukumbu_namba' => $this->string(200)->notNull()->unique(),
            'shehia_id' => $this->integer()->notNull(),
            'active_wazee_jumla' => $this->integer(),
            'jumla_fedha' => $this->decimal(10,2),
            'msimamizi_id' => $this->integer(),
            'jumla_iliyolipwa' => $this->decimal(10,2),
            'jumla_iliyobaki' => $this->decimal(10,2),
            'status' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `shehia_id`
        $this->createIndex(
            'idx-tbl_voucher-shehia_id',
            'tbl_voucher',
            'shehia_id'
        );


        $this->addForeignKey(
            'fk-tbl_voucher-shehia_id',
            'tbl_voucher',
            'shehia_id',
            'tbl_shehia',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_voucher');
    }
}
