<?php

namespace common\components;

use Yii;
use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord {
    const STATUS_DELETE = 0;
    const STATUS_DEFAULT = 1;
    
    public static function softFind() {
        return static::find()->andWhere(['!=', 'status', self::STATUS_DELETE]);
    }
    
    public function softDelete() {
        $this->status = self::STATUS_DELETE;
        return $this->update(false, ['status']);
    }
    
    protected static function findByCondition($condition)
    {
        $query = static::softFind();

        if (!ArrayHelper::isAssociative($condition)) {
            // query by primary key
            $primaryKey = static::primaryKey();
            if (isset($primaryKey[0])) {
                $condition = [$primaryKey[0] => $condition];
            } else {
                throw new InvalidConfigException('"' . get_called_class() . '" must have a primary key.');
            }
        }

        return $query->andWhere($condition);
    }
    
    public static function getStatusLabels() {
        return [
            self::STATUS_DEFAULT => '默认',
            self::STATUS_DELETE => '删除',
        ];
    }
    
    public function getStatusLabel() {
        return ArrayHelper::getValue(static::getStatusLabels(), $this->status);
    }
    
    public static function findOrCreate($conditions = []) {
        if (!$model = static::findOne($conditions)) {
            $model = Yii::createObject(static::className());
        }
        return $model;
    }
}
