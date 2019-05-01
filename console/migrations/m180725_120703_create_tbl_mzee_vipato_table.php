<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_mzee_vipato`.
 */
class m180725_120703_create_tbl_mzee_vipato_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_mzee_vipato', [
            'id' => $this->primaryKey(),
            'mzee_id' => $this->integer()->notNull(),
            'kipato_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `mzee_id`
        $this->createIndex(
            'idx-tbl_mzee_vipato-mzee_id',
            'tbl_mzee_vipato',
            'mzee_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee_vipato-mzee_id',
            'tbl_mzee_vipato',
            'mzee_id',
            'tbl_mzee',
            'id',
            'CASCADE'
        );

        // creates index for column `kipato_id`
        $this->createIndex(
            'idx-tbl_mzee_vipato-kipato_id',
            'tbl_mzee_vipato',
            'kipato_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee_vipato-kipato_id',
            'tbl_mzee_vipato',
            'kipato_id',
            'tbl_vipato',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_mzee_vipato');
    }
}
