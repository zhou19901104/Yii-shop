<?php

use yii\db\Schema;
use yii\db\Migration;

class m151104_031934_create_admin_user_table extends Migration
{
    const ADMIN_USER_TABLE = '{{%admin_user}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName == 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::ADMIN_USER_TABLE, [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::ADMIN_USER_TABLE);
    }
}
