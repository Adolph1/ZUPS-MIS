<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_mahitaji_wilaya`.
 */
class m180806_165613_create_tbl_mahitaji_wilaya_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_mahitaji_wilaya', [
            'id' => $this->primaryKey(),
            'wilaya_id' => $this->integer()->notNull(),
            'hitaji_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime()
        ]);


        // creates index for column `wilaya_id`
        $this->createIndex(
            'idx-tbl_mahitaji_wilaya-wilaya_id',
            'tbl_mahitaji_wilaya',
            'wilaya_id'
        );


        $this->addForeignKey(
            'fk-tbl_mahitaji_wilaya-wilaya_id',
            'tbl_mahitaji_wilaya',
            'wilaya_id',
            'tbl_wilaya',
            'id',
            'CASCADE'
        );

        // creates index for column `hitaji_id`
        $this->createIndex(
            'idx-tbl_mahitaji_wilaya-hitaji_id',
            'tbl_mahitaji_wilaya',
            'hitaji_id'
        );


        $this->addForeignKey(
            'fk-tbl_mahitaji_wilaya-hitaji_id',
            'tbl_mahitaji_wilaya',
            'hitaji_id',
            'tbl_mahitaji',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_mahitaji_wilaya');
    }
}
