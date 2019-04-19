<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_sheha_masaidizi`.
 */
class m180807_040239_create_tbl_sheha_masaidizi_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_sheha_masaidizi', [
            'id' => $this->primaryKey(),
            'sheha_id' => $this->integer()->notNull(),
            'jina_kamili' => $this->string(200)->notNull(),
            'tarehe_kuzaliwa' => $this->date(),
            'anuani_kamili' => $this->string(200),
            'nambari_ya_simu' => $this->string(200),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime()
        ]);

        // creates index for column `sheha_id`
        $this->createIndex(
            'idx-tbl_sheha_masaidizi-sheha_id',
            'tbl_sheha_masaidizi',
            'sheha_id'
        );


        $this->addForeignKey(
            'fk-tbl_sheha_masaidizi-sheha_id',
            'tbl_sheha_masaidizi',
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
        $this->dropTable('tbl_sheha_masaidizi');
    }
}
