<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_014137_create_product_attribute_assignment_table extends Migration
{
    const PRODUCT_ATTRIBUTE_ASSIGNMENT_TABLE = '{{%product_attribute_assignment}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_ATTRIBUTE_ASSIGNMENT_TABLE, [
            'product_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'attribute_option' => $this->string(16)->notNull(),
            'price' => $this->decimal(8, 2)->notNull()->defaultValue(0.00),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('product_id', self::PRODUCT_ATTRIBUTE_ASSIGNMENT_TABLE, 'product_id');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_ATTRIBUTE_ASSIGNMENT_TABLE);
    }
}
