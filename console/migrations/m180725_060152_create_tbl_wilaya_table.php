<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_wilaya`.
 */
class m180725_060152_create_tbl_wilaya_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_wilaya', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
            'mkoa_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `mkoa_id`
        $this->createIndex(
            'idx-tbl_wilaya-mkoa_id',
            'tbl_wilaya',
            'mkoa_id'
        );


        $this->addForeignKey(
            'fk-tbl_wilaya-mkoa_id',
            'tbl_wilaya',
            'mkoa_id',
            'tbl_mkoa',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_wilaya');
    }
}
