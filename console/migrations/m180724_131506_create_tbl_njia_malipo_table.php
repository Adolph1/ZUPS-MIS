<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_njia_malipo`.
 */
class m180724_131506_create_tbl_njia_malipo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_njia_malipo', [
            'id' => $this->primaryKey(),
            'jina' => $this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_njia_malipo');
    }
}
