<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_kituo_shehia`.
 */
class m180809_201041_create_tbl_kituo_shehia_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_kituo_shehia', [
            'id' => $this->primaryKey(),
            'shehia_id' => $this->integer(),
            'kituo_id' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
        ]);

        // creates index for column `shehia_id`
        $this->createIndex(
            'idx-tbl_kituo_shehia-shehia_id',
            'tbl_kituo_shehia',
            'shehia_id'
        );


        $this->addForeignKey(
            'fk-tbl_kituo_shehia-shehia_id',
            'tbl_kituo_shehia',
            'shehia_id',
            'tbl_shehia',
            'id',
            'CASCADE'
        );

        // creates index for column `kituo_id`
        $this->createIndex(
            'idx-tbl_kituo_shehia-kituo_id',
            'tbl_kituo_shehia',
            'kituo_id'
        );


        $this->addForeignKey(
            'fk-tbl_kituo_shehia-kituo_id',
            'tbl_kituo_shehia',
            'kituo_id',
            'tbl_vituo',
            'id',
            'CASCADE'
        );


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_kituo_shehia');
    }
}
