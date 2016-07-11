<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_014042_create_product_attribute_category_table extends Migration
{
    const PRODUCT_ATTRIBUTE_CATEGORY_TABLE = '{{%product_attribute_category}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_ATTRIBUTE_CATEGORY_TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()->unique(),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_ATTRIBUTE_CATEGORY_TABLE);
    }
}
