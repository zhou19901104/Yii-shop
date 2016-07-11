<?php

namespace common\models;

use Yii;
use common\components\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\base\InvalidCallException;

class ProductCategory extends ActiveRecord {
    public static function tableName() {
        return "{{%product_category}}";
    }
    
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    public function rules() {
        return [
            ['status', 'default', 'value' => self::STATUS_DEFAULT],
            ['parent_id', 'number', 'integerOnly' => true],
            ['parent_id', 'default', 'value' => 0],
            [['name', 'status'], 'required'],
            [['name', 'slug', 'icon_class'], 'string'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Id'),
            'name' => Yii::t('app', 'Product Category Name'),
            'parent_id' => Yii::t('app', 'Product Category Parent'),
            'level' => Yii::t('app', 'Product Category Level'),
            'slug' => Yii::t('app', 'Slug'),
            'icon_class' => Yii::t('app', 'Icon Class'),
            'display_order' => Yii::t('app', 'Display Order'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    
    public function getParent() {
        return $this->hasOne(static::className(), ['id' => 'parent_id']);
    }
    
    public function getChildrens() {
        return $this->hasMany(static::className(), ['id' => 'parent_id']);
    }
    
    public function getTop() {
        return static::softFind()->andWhere(['parent_id' => 0]);
    }
    
    public function getIsTop() {
        return $this->parent_id == 0;
    }
    
    public static function getTreeIdNameList($refresh = false) {
        static $_treeList;
        if (!isset($_treeList) || $refresh) {
            $_treeList = ArrayHelper::merge([0 => ''], static::buildSelectTree(static::getList()));
        }
        return $_treeList;
    }
    
    protected static function buildSelectTree($childrens, $level = 0, $parent_id = 0) {
        static $_tree = [];
        foreach($childrens as $index => $children) {
            if ($parent_id == $children->parent_id) {
                $_tree[$children->id] = str_repeat('-', $level * 4) . $children->name;
                unset($childrens[$index]);
                static::buildSelectTree($childrens, $level + 1, $children->id);
            }
        }
        return $_tree;
    }
    
    public static function getList($refresh = false) {
        static $_list;
        if (!isset($_list) || $refresh) {
            $_list = [];
            foreach(static::softFind()->all() as $productCategory) {
                $_list[$productCategory->id] = $productCategory;
            }
        }
        return $_list;
    }

    public static function getListByLevel($level = 1) {
        static $_list;
        if (!isset($_list)) {
            $_list = [];
            foreach(static::getList() as $productCategory) {
                if ($productCategory->level == $level) {
                    $_list[$productCategory->id] = $productCategory;
                }
            }
        }
        return $_list;
    }

    public static function getListByParentId($parentId) {
        $_list = [];
        foreach(static::getList() as $productCategory) {
            if ($productCategory->parent_id == $parentId) {
                $_list[$productCategory->id] = $productCategory;
            }
        }
        return $_list;
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->level = static::calculateLevel($this);
            return true;
        } else {
            return false;
        }
    }

    public static function calculateLevel(ProductCategory $productCategory, $refresh = false) {
        $level = 1;
        $existsIds = [$productCategory->id];
        $loopProductCategory = $productCategory;
        while($loopProductCategory && $loopProductCategory->parent_id) {
            if (in_array($loopProductCategory->parent_id, $existsIds)) {
                throw new InvalidCallException(Yii::t('app', 'Ocurr Limitless Recursive call.'));
            }
            $level = $level + 1;
            $loopProductCategory = ArrayHelper::getValue(static::getList($refresh), $loopProductCategory->parent_id);
            $extends[] = $loopProductCategory->id;
        }
        return $level;
    }
}
