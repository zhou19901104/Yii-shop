<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_014101_create_product_attribute_table extends Migration
{
    const PRODUCT_ATTRIBUTE_TABLE = '{{%product_attribute}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_ATTRIBUTE_TABLE, [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string(16)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'option' => $this->string(200),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('category_id', self::PRODUCT_ATTRIBUTE_TABLE, 'category_id');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_ATTRIBUTE_TABLE);
    }
}
