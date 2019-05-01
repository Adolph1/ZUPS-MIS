<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_mzee`.
 */
class m180725_060245_create_tbl_mzee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_mzee', [
            'id' => $this->primaryKey(),
            'fomu_namba' => $this->string(200)->notNull()->unique(),
            'picha' => $this->string(200),
            'majina_mwanzo' => $this->string(200)->notNull(),
            'jina_babu' => $this->string(200)->notNull(),
            'jina_maarufu' => $this->string(200),
            'jinsia' => $this->char(1)->notNull(),
            'tarehe_kuzaliwa' => $this->date()->notNull(),
            'umri_kusajiliwa' => $this->integer(),
            'umri_sasa' => $this->integer(),
            'kazi_id' => $this->integer()->notNull(),
            'mzawa_zanzibar' => $this->char(1)->notNull(),
            'aina_ya_kitambulisho' => $this->integer()->notNull(),
            'nambar' => $this->string(200)->notNull(),
            'tarehe_kuingia_zanzibar' => $this->date(),
            'simu' => $this->string(200),
            'mkoa_id' => $this->integer()->notNull(),
            'wilaya_id' => $this->integer()->notNull(),
            'shehia_id' => $this->integer()->notNull(),
            'mtaa' => $this->string(200)->notNull(),
            'namba_nyumba' => $this->string(200)->notNull(),
            'anuani_kamili_mtaa' => $this->string(200)->notNull(),
            'anuani_ya_posta' => $this->string(200)->notNull(),
            'posho_wilaya' => $this->integer()->notNull(),
            'njia_upokeaji' => $this->integer()->notNull(),
            'jina_bank' => $this->integer(),
            'jina_account' => $this->string(200),
            'nambari_account' => $this->string(200),
            'simu_kupokelea' => $this->string(200),
            'wanaomtegemea' => $this->integer(),
            'pension_nyingine' => $this->char(1)->notNull(),
            'aina_ya_pension' => $this->integer(),
            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),
            'anaishi' => $this->char(1)->notNull(),
            'status' => $this->integer(1),
            'tarehe_kufariki' => $this->date(),
            'mtu_karibu' => $this->string(200)->notNull(),
            'jinsia_mtu_karibu' => $this->char(1),
            'tarehe_kuzaliwa_mtu_karibu' => $this->date(),
            'umri_mtu_karibu' => $this->integer(),
            'namba_simu' => $this->string(200),
            'picha_mtu_karibu' => $this->string(200),
            'anuani_kamili_mtu_karibu' => $this->string(200)->notNull(),
            'aina_ya_kitambulisho_mtu_karibu' => $this->integer()->notNull(),
            'nambari_ya_kitambulisho' => $this->string(200)->notNull(),
            'uhasiano' => $this->string(200)->notNull(),
            'mchukua_taarifa_id' => $this->integer()->notNull(),
            'maoni_ofisi_wilaya' => $this->string(200),
            'mzee_finger_print' => $this->text(),
            'mtu_karibu_finger_print' =>$this->text(),

            'aliyeweka' => $this->string(200),
            'muda' => $this->dateTime(),

        ]);

        // creates index for column `shehia_id`
        $this->createIndex(
            'idx-tbl_mzee-shehia_id',
            'tbl_mzee',
            'shehia_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee-shehia_id',
            'tbl_mzee',
            'shehia_id',
            'tbl_shehia',
            'id',
            'CASCADE'
        );


        // creates index for column `kazi_id`
        $this->createIndex(
            'idx-tbl_mzee-kazi_id',
            'tbl_mzee',
            'kazi_id'
        );


        $this->addForeignKey(
            'fk-tbl_mzee-kazi_id',
            'tbl_mzee',
            'kazi_id',
            'tbl_kazi_mzee',
            'id',
            'CASCADE'
        );

        // creates index for column `aina_ya_pension`
        $this->createIndex(
            'idx-tbl_mzee-aina_ya_pension',
            'tbl_mzee',
            'aina_ya_pension'
        );


        $this->addForeignKey(
            'fk-tbl_mzee-aina_ya_pension',
            'tbl_mzee',
            'aina_ya_pension',
            'tbl_pension_nyingine',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_mzee');
    }
}
