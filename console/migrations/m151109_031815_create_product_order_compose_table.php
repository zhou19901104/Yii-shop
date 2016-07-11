<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_031815_create_product_order_compose_table extends Migration
{
    const PRODUCT_ORDER_COMPOSE_TABLE = '{{%product_order_compose}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_ORDER_COMPOSE_TABLE, [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'product_attribute_option_ids' => $this->string(200)->notNull()->defaultValue(""),
            'product_count' => $this->integer()->notNull()->defaultValue(1) . ' comment"购买数量"',
            'settlement_price' => $this->decimal(8, 2)->notNull() . ' comment"结算价格"',
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('order_id', self::PRODUCT_ORDER_COMPOSE_TABLE, 'order_id');
        $this->createIndex('user_id', self::PRODUCT_ORDER_COMPOSE_TABLE, 'user_id');
        $this->createIndex('product_id', self::PRODUCT_ORDER_COMPOSE_TABLE, 'product_id');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_ORDER_COMPOSE_TABLE);
    }
}
