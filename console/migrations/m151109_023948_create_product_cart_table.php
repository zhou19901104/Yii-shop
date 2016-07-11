<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_023948_create_product_cart_table extends Migration
{
    const PRODUCT_CART_TABLE = '{{%product_cart}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_CART_TABLE, [
            'id' => $this->primaryKey(),
            'user_id' => $this->bigInteger()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'product_attribute_assignment_ids' => $this->string(200)->notNull(),
            'quantity' => $this->integer()->notNull(),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('user_id', self::PRODUCT_CART_TABLE, 'user_id');
        $this->createIndex('product_id', self::PRODUCT_CART_TABLE, 'product_id');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_CART_TABLE);
    }
}
