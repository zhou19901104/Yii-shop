<?php

use yii\db\Schema;
use yii\db\Migration;

class m151106_065514_create_product_picture_table extends Migration
{
    const PRODUCT_PICTURE_TABLE = '{{%product_picture}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_PICTURE_TABLE, [
            'product_id' => $this->integer()->notNull(),
            'value' => $this->string(128)->notNull(),
            'display_order' => $this->integer()->notNull()->defaultValue(0),
            
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('product_id', self::PRODUCT_PICTURE_TABLE, 'product_id');
        $this->createIndex('display_order', self::PRODUCT_PICTURE_TABLE, 'display_order');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_PICTURE_TABLE);
    }
}
