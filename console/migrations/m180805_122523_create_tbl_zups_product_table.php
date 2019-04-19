<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_zups_product`.
 */
class m180805_122523_create_tbl_zups_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_zups_product', [
            'id' => $this->primaryKey(),
            'product_code' => $this->string(4)->unique(),
            'kiasi' => $this->decimal()->notNull(),
            'maelezo' => $this->string(200)->notNull(),
            'status' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_zups_product');
    }
}
