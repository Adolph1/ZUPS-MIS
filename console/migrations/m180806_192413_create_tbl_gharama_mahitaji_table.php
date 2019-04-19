<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_gharama_mahitaji`.
 */
class m180806_192413_create_tbl_gharama_mahitaji_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_gharama_mahitaji', [
            'id' => $this->primaryKey(),
            'budget_id' => $this->integer(),
            'hitaji_id' => $this->integer(),
            'wilaya_id' => $this->integer(),
            'idadi_ya_siku' => $this->integer(),
            'idadi_ya_vitu' => $this->integer(),
            'gharama' => $this->decimal(10,2),
            'total' => $this->decimal(10,2),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime()
        ]);

        // creates index for column `budget_id`
        $this->createIndex(
            'idx-tbl_gharama_mahitaji-budget_id',
            'tbl_gharama_mahitaji',
            'budget_id'
        );


        $this->addForeignKey(
            'fk-tbl_gharama_mahitaji-budget_id',
            'tbl_gharama_mahitaji',
            'budget_id',
            'tbl_budget',
            'id',
            'RESTRICT'
        );

        // creates index for column `wilaya_id`
        $this->createIndex(
            'idx-tbl_gharama_mahitaji-wilaya_id',
            'tbl_gharama_mahitaji',
            'wilaya_id'
        );


        $this->addForeignKey(
            'fk-tbl_gharama_mahitaji-wilaya_id',
            'tbl_gharama_mahitaji',
            'wilaya_id',
            'tbl_wilaya',
            'id',
            'RESTRICT'
        );

        // creates index for column `hitaji_id`
        $this->createIndex(
            'idx-tbl_gharama_mahitaji-hitaji_id',
            'tbl_gharama_mahitaji',
            'hitaji_id'
        );


        $this->addForeignKey(
            'fk-tbl_gharama_mahitaji-hitaji_id',
            'tbl_gharama_mahitaji',
            'hitaji_id',
            'tbl_mahitaji',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_gharama_mahitaji');
    }
}
