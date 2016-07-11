<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_015332_create_product_inventory_table extends Migration
{
    const PRODUCT_INVENTORY_TABLE = '{{%product_inventory}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_INVENTORY_TABLE, [
            'product_id' => $this->integer()->notNull(),
            'product_attribute_assignment_ids' => $this->string(128)->notNull(),
            'inventory' => $this->integer()->notNull(),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('product_id', self::PRODUCT_INVENTORY_TABLE, 'product_id');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_INVENTORY_TABLE);
    }
}
