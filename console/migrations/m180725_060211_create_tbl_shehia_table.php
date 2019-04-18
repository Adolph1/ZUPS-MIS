<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_shehia`.
 */
class m180725_060211_create_tbl_shehia_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_shehia', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
            'wilaya_id' => $this->integer()->notNull(),
            'sheha_id' => $this->integer()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `wilaya_id`
        $this->createIndex(
            'idx-tbl_shehia-wilaya_id',
            'tbl_shehia',
            'wilaya_id'
        );


        $this->addForeignKey(
            'fk-tbl_shehia-wilaya_id',
            'tbl_shehia',
            'wilaya_id',
            'tbl_wilaya',
            'id',
            'CASCADE'
        );

        // creates index for column `sheha_id`
        $this->createIndex(
            'idx-tbl_shehia-sheha_id',
            'tbl_shehia',
            'sheha_id'
        );


        $this->addForeignKey(
            'fk-tbl_shehia-sheha_id',
            'tbl_shehia',
            'sheha_id',
            'tbl_sheha',
            'id',
            'CASCADE'
        );



    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_shehia');
    }
}
