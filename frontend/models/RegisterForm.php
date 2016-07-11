<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $captcha;

    protected $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('app', 'This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('app', 'This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['captcha', 'required'],
            ['captcha', 'captcha', 'captchaAction' => 'user/captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => Yii::t('app', 'Username: '),
            'email' => Yii::t('app', 'Email: '),
            'password' => Yii::t('app', 'Password: '),
            'captcha' => Yii::t('app','Captcha: '),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function register()
    {
        if ($this->validate()) {
            $this->user->username = $this->username;
            $this->user->email = $this->email;
            $this->user->setPassword($this->password);
            $this->user->generateAuthKey();
            if ($this->user->save()) {
                return $this->user;
            }
        }

        return null;
    }

    public function setUser(User $user) {
        $this->_user = $user;
    }

    public function getUser() {
        if ($this->_user === null) {
            $this->_user = Yii::createObject(User::className());
        }
        return $this->_user;
    }
}
