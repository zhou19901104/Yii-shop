<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product_attribute_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class ProductAttributeCategory extends \common\components\ActiveRecord
{   
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_attribute_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 32],
            ['name', 'unique', 'targetAttribute' => 'name'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    public function getSubAttributes() {
        return $this->hasMany(ProductAttribute::className(), ['category_id' => 'id']);
    }
    
    public static function getList($refresh = false) {
        static $_list;
        if (!isset($_list) || $refresh) {
            $_list = static::softFind()->all();
        }
        return $_list;
    }
}
