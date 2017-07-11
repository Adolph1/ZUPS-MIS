<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_contact`.
 */
class m170628_115521_create_tbl_contact_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_contact', [
            'id' => $this->primaryKey(),
            'phone_number'=>$this->char(13),
            'name'=>$this->string(200),
            'sms_owner_id'=>$this->integer(),
        ]);

        // creates index for column `sms_owner_id`
        $this->createIndex(
            'idx-tbl_contact-sms_owner_id',
            'tbl_contact',
            'sms_owner_id'
        );


        $this->addForeignKey(
            'fk-tbl_contact-sms_owner_id',
            'tbl_contact',
            'sms_owner_id',
            'tbl_sms_owner',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropForeignKey(
            'fk-tbl_contact-sms_owner_id',
            'tbl_contact'
        );

        // drops index for column `sms_owner_id`
        $this->dropIndex(
            'idx-tbl_contact-sms_owner_id',
            'tbl_contact'
        );
        $this->dropTable('tbl_contact');
    }
}
