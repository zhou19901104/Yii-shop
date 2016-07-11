<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\ProductAttribute;
use yii\helpers\ArrayHelper;
use common\behaviors\TrimBehavior;

/**
 * This is the model class for table "{{%product_attribute_assignment}}".
 *
 * @property integer $product_id
 * @property integer $attribute_id
 * @property string $attribute_option
 * @property string $price
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class ProductAttributeAssignment extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_attribute_assignment}}';
    }

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            TimestampBehavior::className(),
            'trim' => [
                'class' => TrimBehavior::className(),
                'attributes' => ['attribute_option'],
            ],
        ]);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id', 'attribute_option'], 'required'],
            [['product_id', 'attribute_id', 'status'], 'integer'],
            [['price'], 'number'],
            [['attribute_option'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
            'attribute_option' => Yii::t('app', 'Attribute Option'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getBelongAttribute() {
        return $this->hasOne(ProductAttribute::className(), ['id' => 'attribute_id']);
    }
}
