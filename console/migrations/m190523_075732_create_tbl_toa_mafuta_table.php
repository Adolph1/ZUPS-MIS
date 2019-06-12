<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_toa_mafuta`.
 */
class m190523_075732_create_tbl_toa_mafuta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_toa_mafuta', [
            'id' => $this->primaryKey(),
            'tarehe' => $this->date(),
            'wilaya_id' => $this->integer()->notNull(),
            'bidhaa_id' => $this->integer()->notNull(),
            'gari' => $this->integer()->notNull(),
            'kiasi' => $this->decimal()->notNull(),
            'vocha' => $this->string(200),
            'maker_id' => $this->string(200),
            'maker_time' => $this->dateTime(),
        ]);

        // creates index for column `bidhaa_id`
        $this->createIndex(
            'idx-tbl_toa_mafuta-bidhaa_id',
            'tbl_toa_mafuta',
            'bidhaa_id'
        );


        $this->addForeignKey(
            'fk-tbl_toa_mafuta-bidhaa_id',
            'tbl_toa_mafuta',
            'bidhaa_id',
            'tbl_mahitaji',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_toa_mafuta');
    }
}
