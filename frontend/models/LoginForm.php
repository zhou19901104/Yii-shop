<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $captcha;
    public $rememberMe;

    protected $_user;

    public function rules() {
        return [
            [['email', 'password', 'captcha'], 'required'],

            ['password', 'validatePassword'],

            ['captcha', 'captcha', 'captchaAction' => 'user/captcha'],
        ];
    }

    public function validatePassword() {
        if (!$this->hasErrors()) {
            if (!$this->user || !$this->user->validatePassword($this->password)) {
                $this->addError('password', Yii::t('app', 'Username Or Password Error.'));
            }
        }
    }

    public function attributeLabels() {
        return [
            'email' => Yii::t('app', 'Email: '),
            'password' => Yii::t('app', 'Password: '),
            'captcha' => Yii::t('app', 'Captcha: '),
        ];
    }

    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function getUser() {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
            $this->_user = $this->_user ? $this->_user : false;
        } 
        return $this->_user;
    }
}
