<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_viambatanisho_mzee`.
 */
class m180823_150355_create_tbl_viambatanisho_mzee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_viambatanisho_mzee', [
            'id' => $this->primaryKey(),
            'mzee_id' => $this->integer(),
            'aina_id' => $this->integer(),
            'kiambatanisho' => $this->string(200),
        ]);

        // creates index for column `mzee_id`
        $this->createIndex(
            'idx-tbl_viambatanisho_mzee-mzee_id',
            'tbl_viambatanisho_mzee',
            'mzee_id'
        );


        $this->addForeignKey(
            'fk-tbl_viambatanisho_mzee-mzee_id',
            'tbl_viambatanisho_mzee',
            'mzee_id',
            'tbl_mzee',
            'id',
            'RESTRICT'
        );


        // creates index for column `aina_id`
        $this->createIndex(
            'idx-tbl_viambatanisho_mzee-aina_id',
            'tbl_viambatanisho_mzee',
            'aina_id'
        );


        $this->addForeignKey(
            'fk-tbl_viambatanisho_mzee-aina_id',
            'tbl_viambatanisho_mzee',
            'aina_id',
            'tbl_viambatanisho',
            'id',
            'RESTRICT'
        );


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_viambatanisho_mzee');
    }
}
