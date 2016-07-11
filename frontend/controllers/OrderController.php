<?php

namespace frontend\controllers;

use Yii;
use common\components\Controller;
use frontend\models\CreateProductOrderForm;

class OrderController extends Controller {
    public function actionCreate() {
        $model = new CreateProductOrderForm();
        $model->load(Yii::$app->request->post(), ''); 
        if (Yii::$app->request->isPost && $model->save(true)) {
            return $this->render('success', compact('model'));
        } else {
            return $this->render('create', compact('model'));
        }
    }
}
