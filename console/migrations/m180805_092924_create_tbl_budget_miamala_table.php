<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_budget_miamala`.
 */
class m180805_092924_create_tbl_budget_miamala_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_budget_miamala', [
            'id' => $this->primaryKey(),
            'kumbukumbu_no' => $this->string(200),
            'module' => $this->string(200),
            'account' => $this->string(200),
            'zone_id' => $this->string(200),
            'kiasi' => $this->decimal(10,2),
            'budget_id' => $this->string(200),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_budget_miamala');
    }
}
