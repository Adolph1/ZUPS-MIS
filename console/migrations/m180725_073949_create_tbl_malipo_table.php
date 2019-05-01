<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_malipo`.
 */
class m180725_073949_create_tbl_malipo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_malipo', [
            'id' => $this->primaryKey(),
            'voucher_id' => $this->integer(),
            'voucher_kumbukumbu_namba' => $this->string(200),
            'siku_kwanza' => $this->date(),
            'siku_pil' => $this->date(),
            'siku_mwisho' => $this->date()->notNull(),
            'mzee_id' => $this->integer(),
            'kiasi' => $this->decimal(10,2),
            'tarehe_malipo' => $this->date(),
            'cashier_id' => $this->string(200),
            'device_number' => $this->string(200),
            'status' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),

        ]);

        // creates index for column `voucher_id`
        $this->createIndex(
            'idx-tbl_malipo-voucher_id',
            'tbl_malipo',
            'voucher_id'
        );


        $this->addForeignKey(
            'fk-tbl_malipo-voucher_id',
            'tbl_malipo',
            'voucher_id',
            'tbl_voucher',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_malipo');
    }
}
