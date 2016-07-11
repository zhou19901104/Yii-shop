<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\User;
use common\models\Product;

class Comment extends \common\components\ActiveRecord
{
    public static function tableName()
    {
        return '{{%comment}}';
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id'], 'required'],
            [['product_id', 'user_id', 'rank', 'status'], 'integer'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'rank' => 'Rank',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
