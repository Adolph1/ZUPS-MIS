<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_mzee_magonjwa`.
 */
class m180725_120727_create_tbl_mzee_magonjwa_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_mzee_magonjwa', [
            'id' => $this->primaryKey(),
            'mzee_id' => $this->integer()->notNull(),
            'ugonjwa_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `mzee_id`
        $this->createIndex(
            'idx-tbl_mzee_magonjwa-mzee_id',
            'tbl_mzee_magonjwa',
            'mzee_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee_magonjwa-mzee_id',
            'tbl_mzee_magonjwa',
            'mzee_id',
            'tbl_mzee',
            'id',
            'CASCADE'
        );

        // creates index for column `ugonjwa_id`
        $this->createIndex(
            'idx-tbl_mzee_magonjwa-ugonjwa_id',
            'tbl_mzee_magonjwa',
            'ugonjwa_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee_magonjwa-ugonjwa_id',
            'tbl_mzee_magonjwa',
            'ugonjwa_id',
            'tbl_magonjwa',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_mzee_magonjwa');
    }
}
