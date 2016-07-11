<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_085003_create_product_comment_table extends Migration
{
    const PRODUCT_COMMENT_TABLE = '{{%product_comment}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_COMMENT_TABLE, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'star' => $this->smallInteger()->notNull()->defaultValue(3),
            'content' => $this->string(300)->notNull(),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('user_id', self::PRODUCT_COMMENT_TABLE, 'user_id');
        $this->createIndex('product_id', self::PRODUCT_COMMENT_TABLE, 'product_id');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_COMMENT_TABLE);
    }
}
