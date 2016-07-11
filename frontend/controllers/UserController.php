<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\RegisterForm;
use frontend\models\LoginForm;
use yii\captcha\CaptchaAction;

class UserController extends Controller
{
    public function actions() {
        return [
            'captcha' => [
                'class' => CaptchaAction::className(),
            ],
        ];
    }

    public function actionLogin() {
        $model = Yii::createObject(LoginForm::className());
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', compact('model'));
    }

    public function actionRegister() {
        $model = Yii::createObject(RegisterForm::className());
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->user->login($model->user);
            return $this->goHome();
        }
        return $this->render('register', compact('model'));
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
