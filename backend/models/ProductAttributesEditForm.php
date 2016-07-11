<?php

namespace backend\models;

use Yii;
use common\components\ActiveRecord;
use common\models\Product;
use common\models\ProductAttributeAssignment;
use yii\helpers\ArrayHelper;

class ProductAttributesEditForm extends ProductEditForm {
    // 产品属性
    public $attribute_assignments = [];
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['attribute_assignments', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_assignments' => Yii::t('app', 'Attribute Assignments'),
        ];
    }
    
    public function save() {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            foreach($this->product->attributeAssignments as $attributeAssignment) {
                $attributeAssignment->delete();
            }
            foreach($this->attribute_assignments as $attributeAssignment) {
                $attributeAssignment['price'] = ArrayHelper::getValue($attributeAssignment, 'price', 0);
                $productAttributeAssignment = ProductAttributeAssignment::findOrCreate([
                    'product_id' => $this->product->id,
                    'attribute_id' => $attributeAssignment['attribute_id'],
                    'attribute_option' => $attributeAssignment['attribute_option'],
                ]);
                $productAttributeAssignment->attributes = [
                    'product_id' => $this->product->id,
                    'attribute_id' => $attributeAssignment['attribute_id'],
                    'attribute_option' => $attributeAssignment['attribute_option'],
                    'price' => $attributeAssignment['price'],
                ];
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
            if ($product->attributeAssignments) {
                foreach($product->attributeAssignments as $attributeAssignment) {
                    $this->attribute_assignments[] = $attributeAssignment->attributes;
                }
            }
        }
    }
}
