<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\components\ActiveRecord;
use common\models\Product;
use common\models\ProductPicture;
use common\models\ProductAttributeAssignment;
use yii\helpers\ArrayHelper;

class ProductEditForm extends Model {
    public $category_id;
    public $name;
    public $code;
    public $inventory;
    public $description;
    public $logo;
    public $our_price;
    public $market_price;
    public $promotion_price;
    public $promotion_start_time;
    public $promotion_end_time;
    public $is_new;
    public $is_hot;
    public $is_best;
    public $display_order;
    public $score;
    public $status;
    
    // 产品的图片集
    public $pictures = [];
    // 产品属性
    public $attributeAssignments = [];
    
    protected $_product;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'code'], 'required'],
            [['name'], 'unique', 'targetClass' => Product::className(), 'filter' => function($query) {
                if (!$this->product->isNewRecord) {
                    $query->andWhere(['!=', 'id', $this->product->id]);
                }
            }],
            [['category_id', 'inventory', 'is_new', 'is_hot', 'is_best', 'display_order', 'score', 'status'], 'integer'],
            [['description', 'promotion_start_time', 'promotion_end_time'], 'string'],
            [['our_price', 'market_price', 'promotion_price'], 'number'],
            [['name'], 'string', 'max' => 32],
            [['logo'], 'each', 'rule' => ['string', 'max' => 128]],
            [['pictures'], 'each', 'rule' => ['required']],
            [['is_new', 'is_best', 'is_hot'], 'default', 'value' => 0],
            ['status', 'default', 'value' => ActiveRecord::STATUS_DEFAULT],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'inventory' => Yii::t('app', 'Inventory'),
            'description' => Yii::t('app', 'Description'),
            'logo' => Yii::t('app', 'Logo'),
            'our_price' => Yii::t('app', 'Our Price'),
            'market_price' => Yii::t('app', 'Market Price'),
            'promotion_price' => Yii::t('app', 'Promotion Price'),
            'promotion_start_time' => Yii::t('app', 'Promotion Start Time'),
            'promotion_end_time' => Yii::t('app', 'Promotion End Time'),
            'is_new' => Yii::t('app', 'Is New'),
            'is_hot' => Yii::t('app', 'Is Hot'),
            'is_best' => Yii::t('app', 'Is Best'),
            'display_order' => Yii::t('app', 'Display Order'),
            'score' => Yii::t('app', 'Score'),
            'status' => Yii::t('app', 'Status'),
            'pictures' => Yii::t('app', 'Product Pictures'),
        ];
    }
    
    public function save() {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($this->promotion_start_time && $this->promotion_end_time) {
                $this->promotion_start_time = strtotime($this->promotion_start_time);
                $this->promotion_end_time = strtotime($this->promotion_end_time);
            } else {
                $this->promotion_start_time = 0;
                $this->promotion_end_time = 0;
            }
            if ($this->logo) {
                $this->logo = ArrayHelper::getValue($this->logo, 'path');
            }
            $this->product->attributes = $this->attributes;
            if (!$this->product->save()) {
                return false;
            }
            ProductPicture::deleteAll(['product_id' => $this->product->id]);
            if ($this->pictures) {
                foreach($this->pictures as $picture) {
                    $productPicture = Yii::createObject(ProductPicture::className());
                    $productPicture->attributes = [
                        'product_id' => $this->product->id,
                        'value' => ArrayHelper::getValue($picture, 'path'),
                    ];
                    $productPicture->save();
                }
            }
            foreach($this->attributeAssignments as $attributeAssignment) {
                $productAttributeAssignment = ProductAttributeAssignment::findOrCreate([
                    'product_id' => $this->product->id,
                    'attribute_id' => $attributeAssignment['attribute_id'],
                    'attribute_option' => $attributeAssignment['attribute_option'],
                ]);
                $productAttributeAssignment->attributes = $attributeAssignment;
                $productAttributeAssignment->save();
            }
            $transaction->commit();
            return true;
        } else {
            return false;
        }
    }
    
    public function setProduct(Product $product) {
        if ($this->_product = $product) {
            $this->category_id = $product->category_id;
            $this->name = $product->name;
            $this->inventory = $product->inventory;
            $this->description = $product->description;
            if ($product->logo) {
                $this->logo = [
                    'base_url' => Yii::$app->params['uploadweb'],
                    'path' => $product->logo,
                ];
            }
            $this->our_price = $product->our_price;
            $this->market_price = $product->market_price;
            $this->promotion_price = $product->promotion_price;
            $this->promotion_start_time = date('Y-m-d', $product->promotion_start_time);
            $this->promotion_end_time = date('Y-m-d', $product->promotion_end_time);
            $this->is_new = $product->is_new;
            $this->is_hot = $product->is_hot;
            $this->is_best = $product->is_best;
            $this->display_order = $product->display_order;
            $this->score = $product->score;
            $this->status = $product->status;
            if ($product->pictures) {
                foreach($product->pictures as $productPicture) {
                    $this->pictures[] = [
                        'base_url' => Yii::$app->params['uploadweb'],
                        'path' => $productPicture->value,
                    ];
                }
            }
            if ($product->attributeAssignments) {
                foreach($product->attributeAssignments as $attributeAssignment) {
                    $this->attributeAssignments[] = $attributeAssignment->attributes;
                }
            }
        }
    }
    
    public function getProduct() {
        if (!isset($this->_product)) {
            $this->_product = Yii::createObject(Product::className());
        }
        return $this->_product;
    }
}
