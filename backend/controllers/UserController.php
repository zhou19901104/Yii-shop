<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\components\actions\CaptchaAction;
use yii\filters\AccessControl;
use backend\models\AdminUserLoginForm;

class UserController extends Controller {
    public function actions() {
        return [
            'captcha' => [
                'class' => CaptchaAction::className(),
                'transparent' => true,
                'foreColor' => 0xcccccc,
            ],
        ];
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin() {
        $adminUserLoginForm = Yii::createObject(AdminUserLoginForm::className());
        if ($adminUserLoginForm->load(Yii::$app->request->post()) && $adminUserLoginForm->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', compact('adminUserLoginForm'));
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}