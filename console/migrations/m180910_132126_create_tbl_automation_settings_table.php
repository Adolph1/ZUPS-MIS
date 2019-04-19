<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_automation_settings`.
 */
class m180910_132126_create_tbl_automation_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_automation_settings', [
            'id' => $this->primaryKey(),
            'zone_id' => $this->integer(),
            'malipo_kwanza' => $this->integer(),
            'malipo_ya_mwisho' => $this->integer(),
            'mwisho_kuaandaa_voucher' => $this->integer(),
            'muda_wa_voucher' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime()
        ]);
        // creates index for column `zone_id`
        $this->createIndex(
            'idx-tbl_automation_settings-zone_id',
            'tbl_automation_settings',
            'zone_id'
        );


        $this->addForeignKey(
            'fk-tbl_automation_settings-zone_id',
            'tbl_automation_settings',
            'zone_id',
            'tbl_zone',
            'id',
            'RESTRICT'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_automation_settings');
    }
}
