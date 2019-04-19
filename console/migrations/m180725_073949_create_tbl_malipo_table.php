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
            'siku_kwanza' => $this->date(),
            'siku_pili' => $this->date(),
            'siku_mwisho' => $this->date(),
            'shehia_id' => $this->integer(),
            'mzee_id' => $this->integer(),
            'kiasi' => $this->decimal(10,2),
            'tarehe_kulipwa' => $this->date(),
            'cashier_id' => $this->string(200),
            'device_number' => $this->string(200),
            'kituo_id' => $this->integer(),
            'status' => $this->integer(),
            'aliyelipwa' => $this->integer(),
            'muda' => $this->dateTime(),

        ]);

        // creates index for column `mzee_id`
        $this->createIndex(
            'idx-tbl_malipo-mzee_id',
            'tbl_malipo',
            'mzee_id'
        );


        $this->addForeignKey(
            'fk-tbl_malipo-mzee_id',
            'tbl_malipo',
            'mzee_id',
            'tbl_mzee',
            'id',
            'RESTRICT'
        );

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
            'RESTRICT'
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
