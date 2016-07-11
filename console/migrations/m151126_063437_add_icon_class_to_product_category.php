<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ProductCategory;

class m151126_063437_add_icon_class_to_product_category extends Migration
{
    public function up()
    {
        $this->addColumn(ProductCategory::tableName(), 'icon_class', $this->string(32)->notNull()->defaultValue(''));
    }

    public function down()
    {
        $this->dropColumn(ProductCategory::tableName(), 'icon_class');
    }
}
