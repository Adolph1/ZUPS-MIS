<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_mkoa`.
 */
class m180725_060130_create_tbl_mkoa_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_mkoa', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
            'zone_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `zone_id`
        $this->createIndex(
            'idx-tbl_mkoa-zone_id',
            'tbl_mkoa',
            'zone_id'
        );


        $this->addForeignKey(
            'fk-tbl_mkoa-zone_id',
            'tbl_mkoa',
            'zone_id',
            'tbl_zone',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_mkoa');
    }
}
