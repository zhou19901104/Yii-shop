<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_091155_create_user_table extends Migration
{
    const USER_TALBLE = '{{%user}}';
    public function up()
    {
        $this->createTable(self::USER_TALBLE, [
            'id' => $this->primaryKey(),
            'email' => $this->string(32)->notNull()->unique(),
            'username' => $this->string(16)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
    }

    public function down()
    {
        $this->dropTable(self::USER_TALBLE);
    }
}
