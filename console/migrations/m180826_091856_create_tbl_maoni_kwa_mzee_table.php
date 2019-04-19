<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_maoni_kwa_mzee`.
 */
class m180826_091856_create_tbl_maoni_kwa_mzee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_maoni_kwa_mzee', [
            'id' => $this->primaryKey(),
            'mzee_id' => $this->integer(),
            'sababu' => $this->text()->notNull(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);
        // creates index for column `mzee_id`
        $this->createIndex(
            'idx-tbl_maoni_kwa_mzee-mzee_id',
            'tbl_maoni_kwa_mzee',
            'mzee_id'
        );


        $this->addForeignKey(
            'fk-tbl_maoni_kwa_mzee-mzee_id',
            'tbl_maoni_kwa_mzee',
            'mzee_id',
            'tbl_mzee',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_maoni_kwa_mzee');
    }
}
