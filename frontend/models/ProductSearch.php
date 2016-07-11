<?php

namespace frontend\models;

use Yii;
use hightman\xunsearch\ActiveRecord;

class ProductSearch extends ActiveRecord
{
	public static function projectName() {
        return 'shop-product';  // 这将使用 @app/config/another_name.ini 作为项目名
    }

    public function getLogoAccessUrl() {
        return $this->logo ? Yii::$app->params['uploadweb'] . '/' . $this->logo : '';
    }
}
