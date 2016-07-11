<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_031728_create_product_order_table extends Migration
{
    const PRODUCT_ORDER_TABLE = '{{%product_order}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_ORDER_TABLE, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'address' => $this->string(200)->notNull(),
            'paid_time' => $this->integer()->notNull()->defaultValue(0),
            'total_price' => $this->decimal(8, 2)->notNull(),
            'contact' => $this->string(20)->notNull() . ' comment"联系方式"',
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('user_id', self::PRODUCT_ORDER_TABLE, 'user_id');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_ORDER_TABLE);
    }
}
