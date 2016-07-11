<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ProductOrder;

class m151218_034201_add_out_order_no_and_charge_id_to_product_order_table extends Migration
{
    public function up()
    {
        $this->addColumn(ProductOrder::tableName(), 'out_order_no', $this->string(256)->notNull()->defaultValue(''));
        $this->addColumn(ProductOrder::tableName(), 'charge_id', $this->string(256)->notNull()->defaultValue(''));
    }

    public function down()
    {
        $this->dropColumn(ProductOrder::tableName(), 'out_order_no');
        $this->dropColumn(ProductOrder::tableName(), 'charge_id');
    }
}
