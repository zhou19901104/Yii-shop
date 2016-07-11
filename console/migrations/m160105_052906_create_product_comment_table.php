<?php

use yii\db\Schema;
use yii\db\Migration;

class m160105_052906_create_product_comment_table extends Migration
{
    const PRODUCT_COMMENT_TABLE = '{{%comment}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName == 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::PRODUCT_COMMENT_TABLE, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->text(),
            'rank' => $this->smallInteger()->notNull()->defaultValue(1),
            
            'created_at' => $this->integer()->notNull() . ' comment"创建时间"',
            'updated_at' => $this->integer()->notNull() . ' comment"修改时间"',
            'status' => $this->smallInteger()->notNull()->defaultValue(1) . ' comment"状态, 0:删除, 1:默认"',
        ], $tableOptions);

        $this->createIndex('product_id', self::PRODUCT_COMMENT_TABLE, 'product_id');
        $this->createIndex('user_id', self::PRODUCT_COMMENT_TABLE, 'user_id');
        $this->createIndex('product_user', self::PRODUCT_COMMENT_TABLE, ['product_id', 'user_id']);
    }

    public function down()
    {
        $this->dropTable(self::PRODUCT_COMMENT_TABLE);
    }
}
