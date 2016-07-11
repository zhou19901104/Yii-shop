<?php
namespace backend\models;

use Yii;
use common\models\AdminUser;
use yii\base\Model;

class AdminUserLoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $captcha;

    private $_user;

    public function rules()
    {
        return [
            [['email', 'password', 'captcha'], 'required'],
            ['captcha', 'captcha', 'captchaAction' => 'user/captcha'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'captcha' => Yii::t('app', 'Captcha'),
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = AdminUser::findByEmail($this->email);
            $this->_user = $this->_user ? $this->_user : false;
        }

        return $this->_user;
    }
}
