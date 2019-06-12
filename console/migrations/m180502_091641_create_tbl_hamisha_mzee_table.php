<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_hamisha_mzee`.
 */
class m180502_091641_create_tbl_hamisha_mzee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_hamisha_mzee', [
            'id' => $this->primaryKey(),
            'mzee_id' => $this->integer()->notNull(),
            'mkoa_anaokwenda' => $this->integer()->notNull(),
            'wilaya_anayokwenda' => $this->integer()->notNull(),
            'shehia_anayokwenda' => $this->integer()->notNull(),
            'sababu' => $this->string(200)->notNull(),
            'mkoa_aliotoka' => $this->integer(),
            'wilaya_aliyotoka' => $this->integer(),
            'shehia_aliyotoka' => $this->integer(),
            'tarehe' => $this->date()->notNull(),
            'aliyeingiza' => $this->string(200),
            'muda' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_hamisha_mzee');
    }
}
