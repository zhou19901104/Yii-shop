<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product_picture}}".
 *
 * @property integer $product_id
 * @property string $value
 * @property integer $display_order
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class ProductPicture extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'value'], 'required'],
            [['product_id', 'display_order', 'status', 'created_at', 'updated_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_DEFAULT],
            [['value'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'value' => Yii::t('app', 'Value'),
            'display_order' => Yii::t('app', 'Display Order'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getAccessUrl() {
        return $this->value ? Yii::$app->params['uploadweb'] . '/' . $this->value : '';
    }
}
