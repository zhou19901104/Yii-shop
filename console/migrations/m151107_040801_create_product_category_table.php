<?php

use yii\db\Schema;
use yii\db\Migration;

class m151107_040801_create_product_category_table extends Migration
{
    const PRODUCT_CATEGORY_TABLE = '{{%product_category}}';
    public function up()
    {
        $this->createTable(self::PRODUCT_CATEGORY_TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'slug' => $this->string()->notNull()->defaultValue(''),
            'parent_id' => $this->integer()->notNull()->defaultValue(0),
            'display_order' => $this->integer()->notNull()->defaultVAlue(0),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '');
        
        $this->createIndex('parent_id', self::PRODUCT_CATEGORY_TABLE, 'parent_id');
        
        $this->insert(self::PRODUCT_CATEGORY_TABLE, [
            'id' => 0,
            'name' => Yii::t('app', 'rootCategory'),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_CATEGORY_TABLE);
    }
}
