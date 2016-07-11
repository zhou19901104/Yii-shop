<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Product;

class HomeController extends Controller
{
    public function actionIndex() {
        $hotProducts = Product::getHots();
        $bestProducts = Product::getBests();
        $newProducts = Product::getNews();
        $randomProducts = Product::getRandoms();
        return $this->render('index', compact('hotProducts', 'bestProducts', 'newProducts', 'randomProducts'));
    }
}
