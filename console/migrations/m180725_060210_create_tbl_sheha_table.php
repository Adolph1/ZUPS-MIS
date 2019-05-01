<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_sheha`.
 */
class m180725_060210_create_tbl_sheha_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_sheha', [
            'id' => $this->primaryKey(),
            'jina_kamili' => $this->string(200)->notNull(),
            'mtaa' => $this->string(200)->notNull(),
            'nyumba_namba' => $this->string(200),
            'jinsia' => $this->char(1)->notNull(),
            'simu' => $this->string(200)->notNull(),
            'wilaya_id' => $this->integer()->notNull(),
            'tarehe_kuzaliwa' => $this->date(),
            'shehia_id' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
        // creates index for column `wilaya_id`
        $this->createIndex(
            'idx-tbl_sheha-wilaya_id',
            'tbl_sheha',
            'wilaya_id'
        );


        $this->addForeignKey(
            'fk-tbl_sheha-wilaya_id',
            'tbl_sheha',
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
        $this->dropTable('tbl_sheha');
    }
}
