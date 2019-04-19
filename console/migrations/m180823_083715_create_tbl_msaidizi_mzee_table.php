<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_msaidizi_mzee`.
 */
class m180823_083715_create_tbl_msaidizi_mzee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_msaidizi_mzee', [
            'id' => $this->primaryKey(),
            'jina_kamili' => $this->string(200)->notNull(),
            'jinsia' => $this->char(1),
            'mzee_id' => $this->integer()->notNull(),
            'picha' => $this->string(200),
            'anuani' => $this->string(200),
            'tarehe_kuzaliwa' => $this->date(),
            'umri' => $this->integer(),
            'aina_ya_kitambulisho' => $this->integer(),
            'nambari_ya_kitambulisho' => $this->string(200),
            'uhusiano_id' => $this->integer(),
            'status' => $this->integer(),
            'aliyemuweka' => $this->string(200),
            'power_of_attorney' => $this->string(200),
            'tarehe_mwisho_power' => $this->date(),
            'finger_print' => $this->string(200),
            'power_status' => $this->integer(),
            'muda' => $this->dateTime()
        ]);

        // creates index for column `mzee_id`
        $this->createIndex(
            'idx-tbl_msaidizi_mzee-mzee_id',
            'tbl_msaidizi_mzee',
            'mzee_id'
        );


        $this->addForeignKey(
            'fk-tbl_msaidizi_mzee-mzee_id',
            'tbl_msaidizi_mzee',
            'mzee_id',
            'tbl_mzee',
            'id',
            'RESTRICT'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_msaidizi_mzee');
    }
}
