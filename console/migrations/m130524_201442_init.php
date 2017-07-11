<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'role'=>$this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('user',array(
            'username'=>'admin',
            'auth_key' => Yii::$app->security->generatePasswordHash('Ado123'),
            'password_hash' => Yii::$app->security->generatePasswordHash('Ado123'),
            'password_reset_token' => '',
            'email' => 'adolph.cm@gmail.com',
            'status' => '10',
            'role'=>'1',
            'created_at'=>date('Y').date('m').date('d'),
            'updated_at' =>date('Y').date('m').date('d'),
        ));
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
