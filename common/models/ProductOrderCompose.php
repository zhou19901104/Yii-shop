<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_order_compose}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $product_attribute_option_ids
 * @property integer $product_count
 * @property string $settlement_price
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class ProductOrderCompose extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_order_compose}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'product_id', 'settlement_price'], 'required'],
            [['order_id', 'user_id', 'product_id', 'product_count'], 'integer'],
            [['settlement_price'], 'number'],
            [['product_attribute_option_ids'], 'string', 'max' => 200],
            ['status', 'default', 'value' => self::STATUS_DEFAULT],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'product_attribute_option_ids' => Yii::t('app', 'Product Attribute Option Ids'),
            'product_count' => Yii::t('app', 'Product Count'),
            'settlement_price' => Yii::t('app', 'Settlement Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
