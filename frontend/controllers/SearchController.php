<?php

namespace frontend\controllers;

use Yii;
use common\components\Controller;
use frontend\models\ProductSearchForm;

class SearchController extends Controller
{
    public function actionIndex() {
        $keyword = Yii::$app->request->get('keyword');
        $model = new ProductSearchForm();
        $productDp = $model->search($keyword);
        return $this->render('index', compact('keyword', 'productDp'));
    }
}
