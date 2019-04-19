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
            'zone_id' => $this->integer(),
            'kumbukumbu_namba' => $this->string(200)->notNull()->unique(),
            'mwezi' => $this->string(200),
            'mwaka' => $this->string(200),
            'eligible' => $this->integer(),
            'jumla_fedha' => $this->decimal(10,2),
            'jumla_iliyolipwa' => $this->decimal(10,2),
            'jumla_iliyobaki' => $this->decimal(10,2),
            'status' => $this->integer(),
            'aliyeandaa' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `zone_id`
        $this->createIndex(
            'idx-tbl_voucher-zone_id',
            'tbl_voucher',
            'zone_id'
        );


        $this->addForeignKey(
            'fk-tbl_voucher-zone_id',
            'tbl_voucher',
            'zone_id',
            'tbl_zone',
            'id',
            'RESTRICT'
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
