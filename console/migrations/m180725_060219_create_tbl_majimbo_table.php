<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_majimbo`.
 */
class m180725_060219_create_tbl_majimbo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_majimbo', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
            'wilaya_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `wilaya_id`
        $this->createIndex(
            'idx-tbl_majimbo-wilaya_id',
            'tbl_majimbo',
            'wilaya_id'
        );


        $this->addForeignKey(
            'fk-tbl_majimbo-wilaya_id',
            'tbl_majimbo',
            'wilaya_id',
            'tbl_wilaya',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_majimbo');
    }
}
