<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_mzee_ulemavu`.
 */
class m180725_120741_create_tbl_mzee_ulemavu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_mzee_ulemavu', [
            'id' => $this->primaryKey(),
            'mzee_id' => $this->integer()->notNull(),
            'ulemavu_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),

        ]);

        // creates index for column `mzee_id`
        $this->createIndex(
            'idx-tbl_mzee_ulemavu-mzee_id',
            'tbl_mzee_ulemavu',
            'mzee_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee_ulemavu-mzee_id',
            'tbl_mzee_ulemavu',
            'mzee_id',
            'tbl_mzee',
            'id',
            'CASCADE'
        );

        // creates index for column `ulemavu_id`
        $this->createIndex(
            'idx-tbl_mzee_ulemavu-ulemavu_id',
            'tbl_mzee_ulemavu',
            'ulemavu_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee_ulemavu-ulemavu_id',
            'tbl_mzee_ulemavu',
            'ulemavu_id',
            'tbl_ulemavu',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_mzee_ulemavu');
    }
}
