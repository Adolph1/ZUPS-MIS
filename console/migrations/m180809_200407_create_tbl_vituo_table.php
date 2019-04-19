<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_vituo`.
 */
class m180809_200407_create_tbl_vituo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_vituo', [
            'id' => $this->primaryKey(),
            'kituo' => $this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_vituo');
    }
}
