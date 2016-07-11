<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ProductCategory;

class m151209_022638_add_level_to_product_category_table extends Migration
{
    public function up()
    {
        $this->addColumn(ProductCategory::tableName(), 'level', $this->smallInteger()->defaultValue(ProductCategory::STATUS_DEFAULT));
        $this->createIndex('level', ProductCategory::tableName(), 'level');
    }

    public function down()
    {
        $this->dropColumn(ProductCategory::tableName(), 'level');
    }
}
