<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\ProductOrder;

class m151217_060413_add_payment_shipment_to_order extends Migration
{
    public function up()
    {
        $this->addColumn(ProductOrder::tableName(), 'payment', $this->smallInteger()->notNull());
        $this->addColumn(ProductOrder::tableName(), 'shipment', $this->smallInteger()->notNull());
    }

    public function down()
    {
        $this->dropColumn(ProductOrder::tableName(), 'payment');
        $this->dropColumn(ProductOrder::tableName(), 'shipment');
    }
}
