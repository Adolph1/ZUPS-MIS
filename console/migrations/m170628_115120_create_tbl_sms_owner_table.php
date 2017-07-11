<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_sms_owner`.
 */
class m170628_115120_create_tbl_sms_owner_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_sms_owner', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(200),
            'sms_header'=>$this->string(200),
            'sms_content'=>$this->string(200),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_sms_owner');
    }
}
