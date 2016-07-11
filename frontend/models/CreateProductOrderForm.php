<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\ProductOrder;
use common\models\ProductInCart;
use common\models\ProductOrderCompose;

class CreateProductOrderForm extends Model {
    public $address;
    public $contact;
    public $payment;
    public $shipment;

    protected $_productOrder;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['address', 'contact', 'payment', 'shipment'], 'required'],
            [['payment', 'shipment'], 'integer'],
            [['address'], 'string', 'max' => 200],
            [['contact'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'address' => Yii::t('app', 'Address'),
            'contact' => Yii::t('app', 'Contact'),
            'payment' => Yii::t('app', 'Payment'),
            'shipment' => Yii::t('app', 'Shipment'),
        ];
    }

    public function save($validate = true) {
        if ($this->validate($validate) && !Yii::$app->cart->isEmpty) {
            $transaction = Yii::$app->db->beginTransaction();
            $this->productOrder->attributes = [
                'user_id' => Yii::$app->user->identity->id,
                'address' => $this->address,
                'contact' => $this->contact,
                'payment' => $this->payment,
                'shipment' => $this->shipment,
                'total_price' => Yii::$app->cart->cost,
                'status' => ProductOrder::STATUS_CREATED,
            ];
            if (!$this->productOrder->save()) {
                return false;
            }
            foreach(Yii::$app->cart->positions as $productInCart) {
                $productOrderCompose = new ProductOrderCompose();
                $productOrderCompose->attributes = [
                    'order_id' => $this->productOrder->id,
                    'user_id' => Yii::$app->user->identity->id,
                    'product_id' => $productInCart->id,
                    'product_attribute_option_ids' => ProductInCart::getSerializedAttributeAssignments($productInCart->attributeAssignments),
                    'product_count' => $productInCart->quantity,
                    'settlement_price' => $productInCart->cost,
                ];
                if (!$productOrderCompose->save(true)) {
                    return false;
                }
            }
            $transaction->commit();
            Yii::$app->cart->removeAll();
            return true;
        }
        return false;
    }

    public function setProductOrder(ProductOrder $productOrder) {
        if ($this->_productOrder = $productOrder) {
            $this->address = $productOrder->address;
            $this->contact = $productOrder->contact;
            $this->payment = $productOrder->payment;
            $this->shipment = $productOrder->shipment;
        }
    }

    public function getProductOrder() {
        if ($this->_productOrder === null) {
            $this->_productOrder = new ProductOrder();
        }
        return $this->_productOrder;
    }
}
