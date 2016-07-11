<?php

namespace backend\controllers;

use yii\web\Controller;

class WhoopsController extends Controller {
    public function actions() {
        return [
            'error' => [
                'class' => 'backend\components\ErrorAction',
            ],
        ];
    }
}