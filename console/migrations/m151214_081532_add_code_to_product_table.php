<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\Product;

class m151214_081532_add_code_to_product_table extends Migration
{
    public function up()
    {
        $this->addColumn(Product::tableName(), 'code', $this->string(128)->notNull());
    }

    public function down()
    {
        $this->dropColumn(Product::tableName(), 'code');
    }
}
