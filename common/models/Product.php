<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\ProductCategory;
use common\models\ProductPicture;
use common\models\ProductAttributeAssignment;
use common\models\ProductOrderCompose;
use common\models\Comment;
use SORT_DESC;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property integer $inventory
 * @property string $description
 * @property string $logo
 * @property string $our_price
 * @property string $market_price
 * @property string $promotion_price
 * @property integer $promotion_start_time
 * @property integer $promotion_end_time
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $is_best
 * @property integer $display_order
 * @property integer $score
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Product extends \common\components\ActiveRecord
{
    const IS_NEW_NEW = 1;
    const IS_NEW_NOT_NEW = 0;
    
    const IS_HOT_HOT = 1;
    const IS_HOT_NOT_HOT = 0;
    
    const IS_BEST_BEST = 1;
    const IS_BEST_NOT_BEST = 0;
    
    protected $_attributeAssignmentsIdMap;
    protected $_breadcrumbs;
    protected $_relateCategories;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'code'], 'required'],
            [['name'], 'unique'],
            [['category_id', 'inventory', 'promotion_start_time', 'promotion_end_time', 'is_new', 'is_hot', 'is_best', 'display_order', 'score', 'created_at', 'updated_at', 'status'], 'integer'],
            [['description'], 'string'],
            [['our_price', 'market_price', 'promotion_price'], 'number'],
            [['name'], 'string', 'max' => 32],
            [['logo'], 'string', 'max' => 128],
            [['is_new', 'is_best', 'is_hot'], 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_DEFAULT],
            [['display_order', 'score'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    public function getCategory() {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id'])->andWhere(['!=', 'status', self::STATUS_DELETE]);
    }
    
    public function getPictures() {
        return $this->hasMany(ProductPicture::className(), ['product_id' => 'id'])->andWhere(['!=', 'status', self::STATUS_DELETE]);
    }
    
    public function getAttributeAssignments() {
        return $this->hasMany(ProductAttributeAssignment::className(), ['product_id' => 'id'])->andWhere(['!=', 'status', self::STATUS_DELETE]);
    }

    public function getAttributeAssignmentsAttributeIdMap() {
        if (!isset($this->_attributeAssignmentsIdMap)) {
            $this->_attributeAssignmentsIdMap = [];
            foreach($this->attributeAssignments as $productAttributeAssignment) {
                if (!isset($this->_attributeAssignmentsIdMap[$productAttributeAssignment->attribute_id])) {
                    $this->_attributeAssignmentsIdMap[$productAttributeAssignment->attribute_id] = [];
                }
                $this->_attributeAssignmentsIdMap[$productAttributeAssignment->attribute_id][] = $productAttributeAssignment;
            }
        }
        return $this->_attributeAssignmentsIdMap;
    }
    
    public function getAttributeCategory() {
        return ProductAttributeCategory::softFind()
            ->select('product_attribute_category.*')
            ->leftJoin(ProductAttribute::tableName(), '`product_attribute_category`.`id` = `product_attribute`.`category_id`')
            ->leftJoin(ProductAttributeAssignment::tableName(), '`product_attribute_assignment`.`attribute_id` = `product_attribute`.`id`')
            ->leftJoin(static::tableName(), '`product`.`id` = `product_attribute_assignment`.`product_id`')
            ->where(['product.id' => $this->id]);
    }
    
    public static function getIsNewLabels() {
        return [
            self::IS_NEW_NEW => '新品',
            self::IS_NEW_NOT_NEW => '非新品',
        ];
    }
    
    public function getIsNewLabel() {
        return ArrayHelper::getValue(static::getIsNewLabels(), $this->is_new);
    }
    
    public static function getIsHotLabels() {
        return [
            self::IS_HOT_HOT => '热卖',
            self::IS_HOT_NOT_HOT => '非热卖',
        ];
    }
    
    public function getIsHotLabel() {
        return ArrayHelper::getValue(static::getIsHotLabels(), $this->is_hot);
    }
    
    public static function getIsBestLabels() {
        return [
            self::IS_BEST_BEST => '推荐',
            self::IS_BEST_NOT_BEST => '非推荐',
        ];
    }
    
    public function getIsBestLabel() {
        return ArrayHelper::getValue(static::getIsBestLabels(), $this->is_best);
    }
    
    public function getLogoAccessUrl() {
        return $this->logo ? Yii::$app->params['uploadweb'] . '/' . $this->logo : '';
    }

    public function getBreadcrumbs() {
        if ($this->_breadcrumbs === null) {
            $this->_breadcrumbs = [];
            array_unshift($this->_breadcrumbs, [
                'url' => Url::to(['product/view', 'id' => $this->id]),
                'label' => $this->name,
            ]);
            $productCategory = $this->category;
            while($productCategory) {
                array_unshift($this->_breadcrumbs, [
                    'url' => Url::to('#'),
                    'label' => $productCategory->name,
                ]);
                $productCategory = $productCategory->parent;
            }
        }
        return $this->_breadcrumbs;
    }

    public function getRelateCategories() {
        if ($this->_relateCategories === null) {
            $this->_relateCategories = [];
            if ($this->category && $this->category->parent) {
                $this->_relateCategories = ProductCategory::findAll(['parent_id' => $this->category->parent->id]);
            }
        }
        return $this->_relateCategories;
    }

    public static function getHots($limit = 5) {
        return static::softFind()->where(['is_hot' => self::IS_HOT_HOT])->orderBy(['created_at' => SORT_DESC])->limit($limit)->all();
    }

    // 热卖
    public static function getBests($limit = 5) {
        return static::softFind()->where(['is_best' => self::IS_BEST_BEST])->orderBy(['created_at' => SORT_DESC])->limit($limit)->all();
    }

    // 新品
    public static function getNews($limit = 5) {
        return static::softFind()->where(['is_new' => self::IS_NEW_NEW])->orderBy(['created_at' => SORT_DESC])->limit($limit)->all();
    }

    // random
    public static function getRandoms($limit = 5) {
        $command = Yii::$app->db->createCommand(strtr('
SELECT 
    t1.*
FROM
    :product AS t1
        JOIN
    (SELECT 
        ROUND(RAND() * ((SELECT 
                    MAX(id)
                FROM
                    :product) - (SELECT 
                    MIN(id)
                FROM
                    :product)) + (SELECT 
                    MIN(id)
                FROM
                    :product)) AS id
    ) AS t2
WHERE
    t1.id >= t2.id
ORDER BY t1.id
LIMIT :limit;
', [':product' => Yii::$app->db->schema->getRawTableName(static::tableName())]));
        $command->bindValues([
            ':limit' => $limit,
        ]);
        $products = [];
        foreach($command->queryAll() as $productNameValuePairs) {
            $product = new static;
            static::populateRecord($product, $productNameValuePairs);
            $products[] = $product;
        }
        return $products;
    }

    public static function canComment($userId, $productId) {
        return ProductOrderCompose::find()->where(['user_id' => $userId, 'product_id' => $productId])->exists();
    }

    public function getComments() {
        return $this->hasMany(Comment::className(), ['product_id' => 'id']);
    }
}
