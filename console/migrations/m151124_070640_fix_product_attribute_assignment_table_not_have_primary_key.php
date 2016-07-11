<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ProductAttributeAssignment;

class m151124_070640_fix_product_attribute_assignment_table_not_have_primary_key extends Migration
{
    public function up()
    {
        $this->addPrimaryKey('primary key', ProductAttributeAssignment::tableName(), ['product_id', 'attribute_id', 'attribute_option']);
    }

    public function down()
    {
        $this->dropPrimaryKey('primary key', ProductAttributeAssignment::tableName());
    }
}
