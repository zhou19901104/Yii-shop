<?php

use yii\db\Schema;
use yii\db\Migration;

class m151106_060246_create_product_table extends Migration
{
    const PRODUCT_TABLE = '{{%product}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName == 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable(self::PRODUCT_TABLE, [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string(32)->notNull() . ' comment"产品名"',
            'inventory' => $this->integer()->notNull()->defaultValue(1) . ' comment"库存量"',
            'description' => $this->text() . ' comment"产品介绍"',
            'logo' => $this->string(128) . ' comment"产品封面图片"',
            'our_price' => $this->decimal(8, 2) . ' comment"本店价格"',
            'market_price' => $this->decimal(8, 2)->defaultValue(0.00) . ' comment"市场价格"',
            'promotion_price' => $this->decimal(8, 2)->defaultValue(0.00) . ' comment"促销价格"',
            'promotion_start_time' => $this->integer()->notNull()->defaultValue(0) . ' comment"促销开始时间"',
            'promotion_end_time' => $this->integer()->notNull()->defaultValue(0) . ' comment"促销结束时间"',
            'is_new' => $this->smallInteger()->notNull()->defaultValue(0) . ' comment"是否新品"',
            'is_hot' => $this->smallInteger()->notNull()->defaultValue(0) . ' comment"是否热销"',
            'is_best' => $this->smallInteger()->notNull()->defaultValue(0) . ' comment"是否精品"',
            'display_order' => $this->bigInteger()->notNull()->defaultValue(0) . ' comment"显示顺序"',
            'score' => $this->integer()->notNull()->defaultValue(0) . ' comment"赠送积分"',
            
            'created_at' => $this->integer()->notNull() . ' comment"创建时间"',
            'updated_at' => $this->integer()->notNull() . ' comment"修改时间"',
            'status' => $this->smallInteger()->notNull()->defaultValue(1) . ' comment"状态, 0:删除, 1:默认"',
        ], $tableOptions);
        
        $this->createIndex('name', self::PRODUCT_TABLE, 'name', true);
        $this->createIndex('category_id', self::PRODUCT_TABLE, ['category_id']);
        $this->createIndex('status', self::PRODUCT_TABLE, 'status');
        $this->createIndex('display_order', self::PRODUCT_TABLE, 'display_order');
        $this->createIndex('created_at', self::PRODUCT_TABLE, 'created_at');
        $this->createIndex('updated_at', self::PRODUCT_TABLE, 'updated_at');
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_TABLE);
    }
}
