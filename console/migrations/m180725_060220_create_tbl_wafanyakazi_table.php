<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_wafanyakazi`.
 */
class m180725_060220_create_tbl_wafanyakazi_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_wafanyakazi', [
            'id' => $this->primaryKey(),
            'jina_kamili' => $this->string(200),
            'zone_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'wilaya_id' => $this->integer()->notNull(),
            'kazi_id' => $this->integer()->notNull(),
            'report_to' => $this->integer()->notNull(),
            'status' => $this->char(1),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `wilaya_id`
        $this->createIndex(
            'idx-tbl_wafanyakazi-wilaya_id',
            'tbl_wafanyakazi',
            'wilaya_id'
        );


        $this->addForeignKey(
            'fk-tbl_wafanyakazi-wilaya_id',
            'tbl_wafanyakazi',
            'wilaya_id',
            'tbl_wilaya',
            'id',
            'CASCADE'
        );

        // creates index for column `department_id`
        $this->createIndex(
            'idx-tbl_wafanyakazi-department_id',
            'tbl_wafanyakazi',
            'department_id'
        );


        $this->addForeignKey(
            'fk-tbl_wafanyakazi-department_id',
            'tbl_wafanyakazi',
            'department_id',
            'tbl_department',
            'id',
            'CASCADE'
        );


        // creates index for column `kazi_id`
        $this->createIndex(
            'idx-tbl_wafanyakazi-kazi_id',
            'tbl_wafanyakazi',
            'kazi_id'
        );


        $this->addForeignKey(
            'fk-tbl_wafanyakazi-kazi_id',
            'tbl_wafanyakazi',
            'kazi_id',
            'tbl_kazi',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_wafanyakazi');
    }
}
